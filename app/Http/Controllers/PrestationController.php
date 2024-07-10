<?php

namespace App\Http\Controllers;

use App\Models\Devis;
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

    public function offresdevis(Prestation $prestation)
    {
        return view('prestation.devis')->with('prestation', $prestation);
    }



    public function create(Request $request)
    {
        $typeprestation = json_decode($request['type_prestation'], true) ;

        try {
            $validatedData = $request->validate([
                'type_prestation' => 'required|string',
                'debut' => 'required|date',
                'fin' => 'required|date',
                'prix' => 'numeric',
                'addresse' => 'required|string',
                'description' => 'required|string',
                'indications' => 'string',
                'id_reservation' => 'required|integer',
                'id_voyageur' => 'required|integer',
                'id_bailleur' => 'required|integer',
            ]);

            if ($typeprestation['artisan'] == 1) {

                try {
                    $prestation = new Prestation;
                    $prestation->fill($validatedData);
                    $prestation->type = $typeprestation['id'];
                    $prestation->paye_presta = 0;
                    $prestation->paye_pcs = 0;
                    $prestation->genre = $typeprestation['artisan'];
                    $prestation->save();


                    return redirect()->route('reservation.get', ['reservation' => $request['id_reservation']])
                        ->with('success', 'Offre crée avec succes');

                } catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 500);
                }
            } else {
                try {
                    $pourcentage = $typeprestation->pourcentage;
                    $pourcentagepcs = $pourcentage / 100;

                    $prestation = new Prestation;
                    $prestation->fill($validatedData);
                    $prestation->type = $typeprestation['id'];
                    $prestation->paye_presta = $prestation->prix * (1 - $pourcentagepcs);
                    $prestation->paye_pcs = $prestation->prix * $pourcentagepcs;
                    $prestation->genre = $typeprestation['artisan'];
                    $prestation->save();

                    return redirect()->route('reservation.get', ['reservation' => $request['id_reservation']])
                        ->with('success', 'Offre crée avec succes');

                } catch (\Exception $e) {
                    return redirect()->route('reservation.get')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
                }
            }

        }catch (\Exception $e) {
            return redirect()->route('reservation.get')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
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


    public function devis()
    {
        return view('devis');
    }


    public function mesoffresprestations()
    {
        return view('prestation.bailleuroffresprestation');
    }


    public function voiroffresdevis(Prestation $prestation)
    {
        return view('prestation.voiroffresdevis', ['prestation' => $prestation]);
    }

    public function accepter(Devis $devis){



        $devis->etat = 'accepte';
        $devis->save();
        $prestation = Prestation::find($devis->id_prestation);

        $prestation->id_prestataire = $devis->id_prestataire;
        $prestation->state = 'a';
        $prestation->prix = $devis->prix_total;
        $prestation->save();


        Devis::where('id_prestation', $devis->id_prestation)
            ->where(function($query) {
                $query->where('etat', 'envoye')
                        ->orWhere('etat', 'null');
            })
            ->delete();


        return redirect()->route('mesoffresprestations')->with('success', 'Devis accepté avec succès !');

    }

    public function refuserdevis(Devis $devis)
    {
        $idpresta = $devis->id_prestatation;
        // Supprimer le devis
        $devis->delete();

        // Rediriger avec un message de succès
        return redirect()->route('mesoffresprestations');
    }

    public function supprimeroffredevis(Devis $devis)
    {
        $idpresta = $devis->id_prestatation;
        // Supprimer le devis
        $devis->delete();


        // Rediriger avec un message de succès
        return redirect()->route('devisenattente');
    }

}
