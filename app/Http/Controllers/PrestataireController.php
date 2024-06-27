<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\PrestaTypeMission;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PrestataireController extends Controller
{


    public function inscription(){
        return view('prestataire.inscription');
    }

    public function create(Request $request){

        $typePrestationIds = $request->input('type_prestation');

        $missionCount = 0;

        foreach($typePrestationIds as $id) {
            $mission = new PrestaTypeMission();
            $mission->user_id = Auth::id();
            $mission->type_prestation_id = $id;

            $missionDejaSelectionee = PrestaTypeMission::where('type_prestation_id', $id)->where('user_id', Auth::id())->first();

            if (!$missionDejaSelectionee) {
                if($mission->save()) {
                    $missionCount++;
                }
            } elseif ($missionDejaSelectionee) {
                $missionCount++;
            }


        }

// Si toutes les missions ont été ajoutées avec succès, attribuer le rôle
        if($missionCount == count($typePrestationIds)) {
            $roleUser = new Role_user;
            $roleUser->role_id = 4;
            $roleUser->user_id = Auth::id();
            $roleUser->save();



            return 'Votre choix de prestation a bien été enregistré';
        }

        return "Une erreur s'est produite lors de l'ajout des missions et de l'attribution du rôle.";
    }






    /*public function allPrestataires(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $prestataires = User::where('role', 'prestataire')->get();

        return view('presta_views/allpresta', ['prestataires' => $prestataires]);
    }*/

    public function destroy(User $prestataire)
    {
        $prestataire->delete();

        return redirect()->route('prestataires');
    }



}
