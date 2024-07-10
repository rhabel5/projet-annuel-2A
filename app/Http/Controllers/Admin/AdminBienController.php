<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminBienController extends Controller
{
    public function index()
    {
        $biens = Bien::all();
        return view('admin.biens.index', compact('biens'));
    }

    public function create()
    {
        return view('admin.biens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'couchage' => 'required|integer',
            'type_bien' => 'required|string|max:60',
            'type_location' => 'required|string|max:60',
            'ville' => 'required|string|max:60',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|integer',
            'prix_adulte' => 'required|integer',
            'prix_enfant' => 'required|integer',
            'prix_animaux' => 'required|integer',
            'nb_lit' => 'required|integer',
            'piscine' => 'required|boolean',
            'salle_eau' => 'required|integer',
            'nb_chambres' => 'required|integer',
            'dispo' => 'required|integer',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bien = new Bien($request->all());
        $bien->id_bailleur = Auth::id();
        $bien->valide = false; // Biens nécessitant une validation

        $bien->save();

        // Gestion du fichier uploadé
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('images', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        // Création de l'enregistrement Bien
        Bien::create($validated);

        return redirect()->route('admin.biens.index')->with('success', 'Bien ajouté avec succès.');
    }

    public function edit(Bien $bien)
    {
        return view('admin.biens.edit', compact('bien'));
    }

    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'titre' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'couchage' => 'required|integer',
            'type_bien' => 'required|string|max:60',
            'type_location' => 'required|string|max:60',
            'ville' => 'required|string|max:60',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|integer',
            'prix_adulte' => 'required|integer',
            'prix_enfant' => 'required|integer',
            'prix_animaux' => 'required|integer',
            'nb_lit' => 'required|integer',
            'piscine' => 'required|boolean',
            'salle_eau' => 'required|integer',
            'image_url' => 'nullable|string|max:255',
            'nb_chambres' => 'required|integer',
            'dispo' => 'required|integer',
            'valide' => 'required|boolean',
        ]);

        $bien->update($request->all());

        return redirect()->route('admin.biens.index')->with('success', 'Bien mis à jour avec succès.');
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();

        return redirect()->route('admin.biens.index')->with('success', 'Bien supprimé avec succès.');
    }

    public function validateBien($id)
    {
        $bien = Bien::findOrFail($id);
        $bien->valide = true;
        $bien->save();

        return redirect()->route('admin.biens.index')->with('success', 'Bien validé avec succès.');
    }
}