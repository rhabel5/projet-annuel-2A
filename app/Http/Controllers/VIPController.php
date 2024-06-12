<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VIPController extends Controller
{
    public function subscribe(Request $request)
    {
        // Logique pour gérer l'abonnement VIP
        return redirect()->route('voyageur.dashboard')->with('success', 'Vous êtes maintenant un membre VIP!');
    }
}