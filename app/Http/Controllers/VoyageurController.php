<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voyageur;

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

}
