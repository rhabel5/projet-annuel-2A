<?php

namespace App\Http\Controllers;

public function store(Request $request)
{
    $data = $request->validate([
        'property_type' => 'required|string',
        'location' => 'required|string',
        'income_estimate' => 'required|numeric'
    ]);

    // Logique pour enregistrer les données ou effectuer des calculs
    Simulation::create($data);

    return back()->with('success', 'Simulation enregistrée avec succès!');
}
