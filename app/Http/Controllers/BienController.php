<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Role;
use App\Models\Role_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BienController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bailleur' => 'required|integer',
            'description' => 'required|string|max:255',
            'couchage' => 'required|integer',
            'type_bien' => 'required|string|max:255',
            'type_location' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|integer',
            'prix_adulte' => 'required|integer',
            'prix_enfant' => 'required|integer',
            'prix_animaux' => 'required|integer',
            'nb_lit' => 'required|integer',
            'piscine' => 'required|boolean',
            'note_moyenne' => 'nullable|integer',
            'salle_eau' => 'required|integer',
            'images' => 'nullable|string',
            'nb_chambres' => 'required|integer',
            'dispo' => 'nullable|string',
            'valide' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Vérification si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        DB::beginTransaction();
        try {
            // Création de l'enregistrement Bien
            $bien = Bien::create($request->all());

            // Vérification si l'utilisateur a déjà le rôle de bailleur
            $dejaBailleur = Role_user::where('user_id', Auth::id())->where('role_id', 4)->first();
            if (!$dejaBailleur) {
                // Assigner le rôle de bailleur à l'utilisateur
                $roleUser = new Role_user;
                $roleUser->role_id = 4;
                $roleUser->user_id = Auth::id();
                $roleUser->save();
            }

            DB::commit();
            return response()->json(['bien' => $bien, 'message' => 'Property created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred while creating the property:',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        // Récupérer tous les biens depuis la base de données
        $biens = Bien::all();

        // Retourner la vue avec les biens
        return view('welcome', compact('biens'));
    }

    public function update(Request $request, Bien $bien)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'string|max:60',
            'description' => 'string|max:255',
            'couchage' => 'integer',
            'type_bien' => 'string|max:255',
            'type_location' => 'string|max:255',
            'ville' => 'string|max:255',
            'adresse' => 'string|max:255',
            'code_postal' => 'integer',
            'prix_adulte' => 'integer',
            'prix_enfant' => 'integer',
            'prix_animaux' => 'integer',
            'nb_lit' => 'integer',
            'piscine' => 'boolean',
            'note_moyenne' => 'integer',
            'salle_eau' => 'integer',
            'images' => 'integer',
            'nb_chambres' => 'integer',
            'dispo' => 'integer',
            'valide' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bien->update($request->all());
        return response()->json(['bien' => $bien, 'message' => 'Property updated successfully']);
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }

    public function show(Bien $bien)
    {
        return view('bien.show', compact('bien'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $biens = Bien::where('titre', 'LIKE', "%$query%")->get();

        return response()->json($biens);
    }

}
