<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\ElementDevis;
use App\Models\Prestataire;
use App\Models\Prestation;
use App\Models\Reservation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevisController extends Controller
{
    public function index()
    {
        //
    }


    public function create(Request $request)
    {

    try {
        $validatedData = $request->validate([
            'designation' => 'required|array',
            'designation.*' => 'required|string|max:255',
            'quantite' => 'required|array',
            'quantite.*' => 'required|integer|min:1',
            'prixunite' => 'required|array',
            'prixunite.*' => 'required|numeric|min:0',
            'prestation' => 'required'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        echo 'Erreur de validation: ' . $e->getMessage();
    }

        //print_r($request->all());

        $items = $validatedData['designation'];
        //print_r($items) ;
        $quantites = $validatedData['quantite'];
        //print_r($quantites) ;
        $prixunites = $validatedData['prixunite'];
        //print_r($prixunites) ;

        $prestataire = Auth::user();
        $prestataireId = $prestataire['id'];
        //print_r($prestataireId) ;

        //print_r($prestation) ;
        $prestation = json_decode($request->input('prestation'), true); // Le second paramètre définit le résultat en tant que tableau
        $id_reservation = $prestation['id_reservation'];


        $reservation = Reservation::find($id_reservation);
        //print_r($reservation) ;


        try {
            $devis = new Devis();
            $devis->id_prestataire = $prestataireId;
            $devis->id_bailleur = $reservation->id_bailleur;
            $devis->id_reservation = $id_reservation;
            $devis->id_prestation = $prestation['id'];
            $devis->prix_total = 0;
            $devis->save();
        }catch(\Exception $e){
            echo 'Erreur lors de l\'ajout du devis : ' . $e->getMessage();
        }


        $prixtotal = 0;



        for($i = 0; $i < count($items); $i++) {
            try{
                $elementdevis = new ElementDevis();
                $elementdevis->devis_id = $devis->id;
                $elementdevis->designation = $items[$i];
                $elementdevis->quantite = $quantites[$i];
                $elementdevis->prixunite = $prixunites[$i];
                $elementdevis->prixtotal = $prixunites[$i]*$quantites[$i];
                $prixtotal += $prixunites[$i]*$quantites[$i];
                $elementdevis->save();
            }catch(\Exception $e){
                echo 'Erreur lors de l\ajout d\'un élément du devis : ' . $e->getMessage();
            }

        }
        try {
            $devis->prix_total = $prixtotal;
            $devis->save();
        }catch(\Exception $e){
            echo 'Erreur lors de l\'ajout du devis : ' . $e->getMessage();
        }

        //echo $devis->id_prestataire;

        return $this->devispdf($devis);
    }

    public function devispdf($devis)
    {
        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
        $bailleur = User::find($devis->id_bailleur);
        $reservation = Reservation::find($devis->id_reservation);
        $offre = Prestation::find($devis->id_prestation);


        $data = [
            'prestataire' => $prestataire,
            'bailleur' => $bailleur,
            'reservation' => $reservation,
            'offre' => $offre,
        ];
        //print_r($data);
        //return 'lala';


        $pdf = PDF::loadView('devis', $data);
        return $pdf->download('devis.pdf');
    }


}
