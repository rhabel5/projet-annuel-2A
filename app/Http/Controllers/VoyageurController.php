<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Voyageur;
use App\Models\Reservation;

// Make sure you have a Bailleur model correctly set up


class VoyageurController extends Controller
{
    public function allVoyageurs(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $voyageurs = User::where('role', 'voyageur')->get();

        return view('voyageur_views/allvoyageurs', ['voyageurs' => $voyageurs]);
    }

    public function destroy(User $voyageur)
    {
        $voyageur->delete();

        return redirect()->route('voyageurs');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $reservationsAVenir = Reservation::where('id_client', $user->id)->where('date_debut', '>', now())->get();
        $reservationsPassees = Reservation::where('id_client', $user->id)->where('date_fin', '<=', now())->get();

        return view('voyageur.dashboard', compact('user', 'reservationsAVenir', 'reservationsPassees'));
    }

}