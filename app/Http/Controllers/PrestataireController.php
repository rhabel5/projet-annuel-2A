<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\PrestaTypeMission;
use App\Models\Prestataire;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class PrestataireController extends Controller
{


    public function inscription(){
        return view('prestataire.inscription');
    }



    public function create(Request $request){

        $client = new Client();
        try {
            $response = $client->request('GET', 'https://api.insee.fr/entreprises/sirene/V3.11/siret/' . $request['siret'], [
                'headers' => [
                    'Authorization' => 'Bearer 4a2eb9f4-5a2c-33cd-bf4b-f4807765bafc',
                    'Accept'        => 'application/json',
                ],
            ]);
            $data = json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return 'HTTP Request failed: ' . $e->getMessage();
        }

        $prestataire = new Prestataire();

if($data['etablissement']['uniteLegale']['categorieJuridiqueUniteLegale'] == 1000){
   $nom_entreprise = $data['etablissement']['uniteLegale']['prenomUsuelUniteLegale'] . ' ' . $data['etablissement']['uniteLegale']['nomUniteLegale'];
   if($nom_entreprise != $request->input('nom_entreprise')){
       return "Le nom de l'entreprise est incorrect";
   }
    $prestataire->nom_entreprise = $nom_entreprise;
}else{
    $nom_entreprise = $data['etablissement']['uniteLegale']['denominationUniteLegale'];
    if($nom_entreprise != $request->input('nom_entreprise')){
        return "Le nom de l'entreprise est incorrect";
    }
    $prestataire->nom_entreprise = $nom_entreprise;

}


        try{
            $prestataire->save();
            $prestataire->id_prestataire = 0;
            $prestataire->bic = $request->input('bic');
            $prestataire->iban = $request->input('iban');
            $prestataire->adresse_facturation = $request->input('adresse_facturation');
            $prestataire->titulaire_compte = $request->input('titulaire_compte');
            $prestataire->save();
        }catch (\Exception $e){
            return 'Une erreur est survenue lors de l\'enregistrement:' . $e->getMessage();
        }


        //Ajout des types de missions

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
