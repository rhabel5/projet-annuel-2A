<?php

namespace App\Http\Controllers;

use App\Models\Bailleur; // Make sure you have a Bailleur model correctly set up
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BailleurController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'biens' => 'required|integer',
            'id_prestations' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bailleur = Bailleur::create([
            'biens' => $request->biens,
            'id_prestations' => $request->id_prestations
        ]);

        return response()->json(['bailleur' => $bailleur, 'message' => 'Landlord created successfully'], 201);
    }

    public function index()
    {
        $bailleurs = Bailleur::all();
        return response()->json($bailleurs);
    }

    public function update(Request $request, Bailleur $bailleur)
    {
        $validator = Validator::make($request->all(), [
            'biens' => 'integer',
            'id_prestations' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bailleur->update($request->all());
        return response()->json(['bailleur' => $bailleur, 'message' => 'Landlord updated successfully']);
    }

    public function destroy(Bailleur $bailleur)
    {
        $bailleur->delete();
        return response()->json(['message' => 'Landlord deleted successfully']);
    }
}
