<?php
namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\Bien;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Role_user;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;
use Stripe\Stripe;

class ReservationController extends Controller
{
    public function reserverform($bienId){
        $bien = Bien::find($bienId);
        $bailleur = User::find($bien->id_bailleur);

        $anciennesReservations = Reservation::where('id_bien', $bienId)->get();

        $invalidDateRanges = [];

        foreach ($anciennesReservations as $reservation) {
            $invalidDateRanges[] = [
                'start' => Carbon::parse($reservation->date_debut)->format('Y-m-d'),
                'end' => Carbon::parse($reservation->date_fin)->format('Y-m-d')
            ];
        }

        return view('reserverform', ['bien' => $bien, 'bailleur' => $bailleur], compact('invalidDateRanges'));
    }

    public function reserver(Request $request){

        $bien_id = $request->input('bien_id');
        $bien = Bien::find($bien_id);

        //echo $request['dates'];

        $dates = explode('-', $request['dates']);

        $trimdatedebut = trim($dates[0]);
        $trimdatefin = trim($dates[1]);

        //On récupère le nombre de jours
        $dateDebut = DateTime::createFromFormat('d/m/Y', $trimdatedebut);
        $dateFin = DateTime::createFromFormat('d/m/Y', $trimdatefin);
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
        $reservation->date_debut = $dateDebut;
        $reservation->date_fin = $dateFin;
        $reservation->nb_adulte = $request->input('nombre_adultes');
        $reservation->prix_total = $prix_total;
        $reservation->statut = 'reserve';

        $reservation->save();
        return redirect()->route('processpayement', ['reservation' => $reservation]);
    }

    public function formulairepayement(Reservation $reservation)
    {
        return view('formulairepayement', ['reservation' => $reservation]);
    }


    public function processpayement(Reservation $reservation)
    {
        $bien = Bien::find($reservation->id_bien);

        Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Reservation n°' . $reservation->id . ' pour ' . $bien->titre,
                    ],
                    'unit_amount' => $reservation->prix_total * 100, // amount is in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment', // corrected 'payement' to 'payment'
            'success_url' => route('payementsuccess', ['reservation' => $reservation]),
            'cancel_url' => route('payementcancel', ['reservation' => $reservation]),
        ]);

        return redirect()->away($session->url);
    }

    public function payementsuccess(Reservation $reservation){
        $reservation->statut = 'paye';
        $reservation->save();
        return redirect()->route('voyageur.dashboard');
    }

    public function payementcancel(Reservation $reservation){
        $reservation->delete();
        return redirect()->route('voyageur.dashboard');
    }

    public function mesreservations(){
        return view('bailleur.mesreservations');
    }

    public function reservation(Reservation $reservation) {
        return view('bailleur.reservation')->with('reservation', $reservation);
    }



}
