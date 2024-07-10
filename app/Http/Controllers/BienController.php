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
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required',
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
            $dejaBailleur = Role_user::where('user_id', Auth::id())->where('role_id', 3)->first();
            if (!$dejaBailleur) {
                // Assigner le rôle de bailleur à l'utilisateur
                $roleUser = new Role_user;
                $roleUser->role_id = 3;
                $roleUser->user_id = Auth::id();
                $roleUser->save();
            }

            DB::commit();
            return redirect()->route('equipements.select', ['id' => $bien->id]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Une erreur est survenue lors de l\ajout du bien:',
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

    public function mesbiens(){
       return view('bien.mesbiens');
    }


    public function searchbien(Request $request)
    {
        $query = Bien::query();

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        if ($request->filled('type_bien')) {
            $query->where('type_bien', 'like', '%' . $request->input('type_bien') . '%');
        }

        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->input('ville') . '%');
        }

        if ($request->filled('code_postal')) {
            $query->where('code_postal', $request->input('code_postal'));
        }

        if ($request->filled('prix_min')) {
            $query->where('prix_adulte', '>=', $request->input('prix_min'));
        }

        if ($request->filled('prix_max')) {
            $query->where('prix_adulte', '<=', $request->input('prix_max'));
        }

        $biens = $query->get();

        return view('bien.index', compact('biens'));
    }

    public function searchbienview()
    {
        return view('recherche');
    }


    public function ajoutImage(Request $request){

    }

    public function ajoutImageForm(Bien $bien){
        return view('bien.ajoutimage', compact('bien'));
    }

}
