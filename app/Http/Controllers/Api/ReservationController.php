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
    public function show(Request $request)
    {
        // Assurez-vous que l'utilisateur est authentifié
        $user = $request->user();
        
        // Récupérer les réservations de l'utilisateur
        $reservations = Reservation::where('user_id', $user->id)->get();

        return response()->json($reservations, 200);
    }
}