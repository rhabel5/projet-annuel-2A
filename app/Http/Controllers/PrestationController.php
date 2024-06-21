<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use App\Models\Reservation;
use App\Models\TypePrestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestationController extends Controller
{

   public function prestationsOffres(){
       return view('prestation.offres');
   }

    public function offreprestation(Reservation $reservation){
        return view('prestation.offrepost')->with('reservation',$reservation);
    }
    public function offreform(TypePrestation $typeprestation, Reservation $reservation){
        return view('prestation.offreform')->with([
            'typeprestation' => $typeprestation,
            'reservation' => $reservation,
        ]);
    }




    public function create(Request $request)
    {
        $type = TypePrestation::find($request['type']);
        try {
            $validatedData = $request->validate([
                'type' => 'required|string',
                'debut' => 'required|date',
                'fin' => 'required|date',
                'prix' => 'required|numeric',
                'addresse' => 'required|string',
                'description' => 'required|string',
                'indications' => 'required|string',
                'id_reservation' => 'required|integer',
                'id_voyageur' => 'required|integer',
                'id_bailleur' => 'required|integer',
            ]);

            $prestation = new Prestation;
            $prestation->fill($validatedData);
            $prestation->paye_presta = $prestation->paye_presta * (($type->pourcentage_pcs * 0.01));
            $prestation->paye_pcs = $prestation->paye_presta * (($type->pourcentage_pcs * 0.01));
            $prestation->save();

            return response()->json(['message' => 'Prestation created successfully', 'data' => $prestation], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function offresaccept(Prestation $prestation)
    {

        $prestation->state = 'a';
        $prestation->id_prestataire = Auth::id();
        $prestation->save();

        return redirect()->back()->with('status', 'Offre acceptée avec succès !');
    }


    public function mesprestations()
    {
        return view('prestation.mesprestations');
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

}
