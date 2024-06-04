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

        return view('voyageur/allvoyageurs', ['voyageurs' => $voyageurs]);
    }

    public function destroy(User $voyageur)
    {
        $voyageur->delete();

        return redirect()->route('voyageurs');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $reservationsAVenir = Reservation::where('id_client', $user->id)
                                        ->where('date_debut', '>', now())
                                        ->with('bien')
                                        ->get();
        $reservationsPassees = Reservation::where('id_client', $user->id)
                                         ->where('date_fin', '<=', now())
                                         ->with('bien')
                                         ->get();

        return view('voyageur.dashboard', compact('user', 'reservationsAVenir', 'reservationsPassees'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'birthdate' => 'required|date',
            'tel' => 'nullable|string|max:20',
        ]);

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'tel' => $request->tel,
        ]);

        return redirect()->route('voyageur.dashboard')->with('success', 'Profil mis à jour avec succès.');
    }

}