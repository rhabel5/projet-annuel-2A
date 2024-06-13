<?php
namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\Bien;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Role_user;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    public function reserverform($bienId){
        $bien = Bien::find($bienId);
        $bailleur = User::find($bien->id_bailleur);

        return view('reserverform', ['bien' => $bien, 'bailleur' => $bailleur]);
    }

    public function reserver(Request $request){

        $bien_id = $request->input('bien_id');
        $bien = Bien::find($bien_id);


        //On récupère le nombre de jours
        $dateDebut = new DateTime($request->input('date_debut'));
        $dateFin = new DateTime($request->input('date_fin'));
        $intervale = $dateDebut->diff($dateFin);
        $jours = $intervale->days;

        $anciennesReservations = Reservation::where('id_bien', $bien_id)->get();

        foreach ($anciennesReservations as $anciennereservation) {
            if (($anciennereservation->date_debut >= $dateDebut && $anciennereservation->date_debut <= $dateFin) ||
                ($anciennereservation->date_fin >= $dateDebut && $anciennereservation->date_fin <= $dateFin) ||
                ($anciennereservation->date_debut <= $dateDebut && $anciennereservation->date_fin >= $dateFin)
            ) {
                return redirect()->back()->with('error', 'La période de réservation est déjà prise.');
            }
        }

        //On calcule le prix total de la réservation
        $prix_total = $bien->prix_adulte * $jours * $request->input('nombre_adultes');


        if(Auth::user()->id == $bien->id_bailleur ){
            return redirect()->back()->with('error', 'Vous ne pouvez pas réserver votre propre bien.');
        }


        $reservation = new Reservation();
        $reservation->id_client = Auth::user()->id;
        $reservation->id_bien = $bien_id;
        $reservation->id_bailleur = $bien->id_bailleur;
        $reservation->date_debut = $request->input('date_debut');
        $reservation->date_fin = $request->input('date_fin');
        $reservation->nb_adulte = $request->input('nombre_adultes');
        $reservation->prix_total = $prix_total;

        $reservation->save();
    }


}
