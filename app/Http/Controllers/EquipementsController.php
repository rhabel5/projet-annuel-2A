<?php

namespace App\Http\Controllers;

use App\Models\Equipements_biens;
use Illuminate\Http\Request;
use App\Models\Equipements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Bien;
use App\Models\Image;

class EquipementsController extends Controller
{
    public function create()
    {
        return view('biens_views/ajout_equipement');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time(). $request->nom. '.' .$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $Equipement = Equipements::create([
            'nom' => $request->nom,
            'image_url' => 'public/images/'.$imageName,
        ]);

        return back()
            ->with('success','L\'équipement a été créé avec succès.')
        ->with('image',$imageName);

    }

    public function select()
    {
        return view('biens_views/selection_equipement');
    }

    public function postselect(Request $request)
    {
        // Accéder à 'equipment' dans la requête
        $equipment_request = $request->input('equipment');
        $bien_id = $request->input('id_bien');

        $bienAppartientBailleur = Bien::where('id', $bien_id)
            ->where('id_bailleur', Auth::id())
            ->first();

        if($bienAppartientBailleur){
            // Vérifier si 'equipment' existe et s'il s'agit bien d'un tableau
            if (is_array($equipment_request)) {
                // Parcourir les données d'équipement
                foreach ($equipment_request as $nom => $value) {
                    if($value == 1){

                        $equipement_id = Equipements::where('nom', $nom)->first()->id;


                        Equipements_biens::create(['id_bien' => $bien_id, 'id_equipement' => $equipement_id]);

                        $image = Image::where('id_bien', $bien_id)->first();
                        if(!$image){
                            return redirect()->route('ajoutImageForm', ['id' => $bien_id]);
                        }

                    }
                }
            }
        }


    }


}
