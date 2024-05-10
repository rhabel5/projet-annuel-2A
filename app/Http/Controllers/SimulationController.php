<?php

namespace App\Http\Controllers;
use App\Models\Simulation; // Importer la classe Simulation
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    // Méthode pour afficher la page de simulation
    public function index()
    {
        return view('simulation');
    }

    // Méthode pour enregistrer les données de simulation
    public function store(Request $request)
    {
        $data = $request->validate([
            'property_type' => 'required|string',
            'location' => 'required|string',
            'income_estimate' => 'required|numeric'
        ]);

        // Logique pour enregistrer les données ou effectuer des calculs
        Simulation::create($data);

        return back()->with('success', 'Simulation enregistrée avec succès !');
    }
}