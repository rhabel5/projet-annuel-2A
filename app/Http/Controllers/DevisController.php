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
use Illuminate\Support\Facades\Storage;

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

        $prestataire = Prestataire::where('id_prestataire',Auth::id())->first();

        $prestataireId = $prestataire->id_prestataire;
        print_r($prestataireId) ;

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
            $devis->etat = 'null';
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
            return $this->showdevis($devis);
        }catch(\Exception $e){
            echo 'Erreur lors de l\'ajout du devis : ' . $e->getMessage();
        }

        //echo $devis->id_prestataire;

        return $this->devispdf($devis, false);
    }

    public function devispdf(Devis $devis, $download)
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
            'devis' => $devis
        ];

        //var_dump($data['bailleur']);
        //print_r($data);
        ///return 'lala';

        if($download){
            $pdf = PDF::loadView('devispdf', $data);

            $fileName = $prestataire->nom_entreprise . '-devis-' . $devis->id . '.pdf';
            $filePath = 'public/devis/' . $fileName;

            // Sauvegarder le fichier sur le serveur
            try{
                Storage::put($filePath, $pdf->output());
            }catch(\Exception $e){
                return 'Erreur lors de l\'ajout du devis : ' . $e->getMessage();
            }
            $devis->etat = 'envoye';
            $devis->save();
            $pdf->download($fileName);
            return redirect()->route('prestation.offres')->with('success', 'Devis envoyé avec succes');

        }

        return view('devis', $data);

    }

    public function showdevis(Devis $devis){
        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
        $bailleur = User::find($devis->id_bailleur);
        $reservation = Reservation::find($devis->id_reservation);
        $offre = Prestation::find($devis->id_prestation);

        $data = [
            'prestataire' => $prestataire,
            'bailleur' => $bailleur,
            'reservation' => $reservation,
            'offre' => $offre,
            'devis' => $devis
        ];


        return view('devis', $data);


    }


    public function telechargerdevis(Devis $devis)
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
            'devis' => $devis
        ];

            $pdf = PDF::loadView('devispdf', $data);

            $fileName = $prestataire->nom_entreprise . '-devis-' . $devis->id . '.pdf';
            $filePath = 'public/devis/' . $fileName;

            // Sauvegarder le fichier sur le serveur
            try{
                Storage::put($filePath, $pdf->output());
            }catch(\Exception $e){
                return 'Erreur lors de l\'ajout du devis sur le serveur : ' . $e->getMessage();
            }
            $devis->etat = 'envoye';
            $devis->save();
            $pdf->download($fileName);
            return $pdf->download($fileName);


    }

}
