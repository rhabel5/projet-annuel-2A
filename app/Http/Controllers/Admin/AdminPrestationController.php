<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestation;
use Illuminate\Http\Request;

class AdminPrestationController extends Controller
{
    public function index()
    {
        $prestations = Prestation::all();
        return view('admin.prestations.index', compact('prestations'));
    }

    public function create()
    {
        return view('admin.prestations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_prestation' => 'required|string',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'prix' => 'numeric',
            'addresse' => 'required|string',
            'description' => 'required|string',
            'indications' => 'string',
            'id_reservation' => 'required|integer',
            'id_voyageur' => 'required|integer',
            'id_bailleur' => 'required|integer',
        ]);

        Prestation::create($validatedData);

        return redirect()->route('admin.prestations.index')->with('success', 'Prestation ajoutée avec succès');
    }

    public function edit(Prestation $prestation)
    {
        return view('admin.prestations.edit', compact('prestation'));
    }

    public function update(Request $request, Prestation $prestation)
    {
        $validatedData = $request->validate([
            'type_prestation' => 'required|string',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'prix' => 'numeric',
            'addresse' => 'required|string',
            'description' => 'required|string',
            'indications' => 'string',
            'id_reservation' => 'required|integer',
            'id_voyageur' => 'required|integer',
            'id_bailleur' => 'required|integer',
        ]);

        $prestation->update($validatedData);

        return redirect()->route('admin.prestations.index')->with('success', 'Prestation mise à jour avec succès');
    }

    public function destroy(Prestation $prestation)
    {
        $prestation->delete();
        return redirect()->route('admin.prestations.index')->with('success', 'Prestation supprimée avec succès');
    }
}