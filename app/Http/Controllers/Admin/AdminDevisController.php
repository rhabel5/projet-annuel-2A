<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devis;
use Illuminate\Http\Request;

class AdminDevisController extends Controller
{
    public function index()
    {
        $devis = Devis::all();
        return view('admin.devis.index', compact('devis'));
    }

    public function create()
    {
        return view('admin.devis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prestataire' => 'required|integer',
            'id_bailleur' => 'required|integer',
            'id_reservation' => 'required|integer',
            'id_prestation' => 'required|integer',
            'prix_total' => 'required|numeric',
            'etat' => 'required|string',
        ]);

        Devis::create([
            'id_prestataire' => $request->id_prestataire,
            'id_bailleur' => $request->id_bailleur,
            'id_reservation' => $request->id_reservation,
            'id_prestation' => $request->id_prestation,
            'prix_total' => $request->prix_total,
            'etat' => $request->etat,
        ]);

        return redirect()->route('admin.devis.index')->with('success', 'Devis created successfully.');
    }

    public function edit(Devis $devis)
    {
        return view('admin.devis.edit', compact('devis'));
    }

    public function update(Request $request, Devis $devis)
    {
        $request->validate([
            'id_prestataire' => 'required|integer',
            'id_bailleur' => 'required|integer',
            'id_reservation' => 'required|integer',
            'id_prestation' => 'required|integer',
            'prix_total' => 'required|numeric',
            'etat' => 'required|string',
        ]);

        $devis->update([
            'id_prestataire' => $request->id_prestataire,
            'id_bailleur' => $request->id_bailleur,
            'id_reservation' => $request->id_reservation,
            'id_prestation' => $request->id_prestation,
            'prix_total' => $request->prix_total,
            'etat' => $request->etat,
        ]);

        return redirect()->route('admin.devis.index')->with('success', 'Devis updated successfully.');
    }

    public function destroy(Devis $devis)
    {
        $devis->delete();
        return redirect()->route('admin.devis.index')->with('success', 'Devis deleted successfully.');
    }
}