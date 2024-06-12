<?php
namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\Bien;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Role_user;
use App\Models\User;
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


        $bien = json_decode($request->input('bien_id'));





        $reservation = new Reservation();
        $reservation->id_client = Auth::user()->id;
        $reservation->id_bien = $bien->id;
        $reservation->id_bailleur = $bien->id_bailleur;
        $reservation->date_debut = $request->input('date_debut');
        $reservation->date_fin = $request->input('date_fin');
        $reservation->nb_adulte = $request->input('nombre_adultes');
        $reservation->prix_total = $bien->prix_adulte * $request->input('nombre_adulte');

        $reservation->save();
    }


}
