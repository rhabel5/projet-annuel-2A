<?php

namespace App\Http\Controllers;

use App\Models\FicheIntervention;
use Illuminate\Http\Request;

class FicheInterventionController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'id_prestataire' => 'required|integer',
            'id_prestation' => 'required|integer',
            'id_bien' => 'required|integer',
            'id_bailleur' => 'required|integer',
            'description' => 'required|string',
            'problemes' => 'required|string',
            'realisee' => 'required|string',
        ]);

        FicheIntervention::create([
            'id_prestataire' => $request->id_prestataire,
            'id_prestation' => $request->id_prestation,
            'id_bien' => $request->id_bien,
            'id_bailleur' => $request->id_bailleur,
            'description' => $request->description,
            'problemes' => $request->problemes,
            'realisee' => $request->realisee,
        ]);

        return view('prestation.mesprestations');
    }

}
