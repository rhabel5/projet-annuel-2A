<?php

namespace App\Http\Controllers;

use App\Models\Bailleur; // Make sure you have a Bailleur model correctly set up
use App\Models\User;
use App\Models\Bien;
use App\Http\Controllers\BienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BailleurController extends Controller
{

//Fonction pour affichier un tableau avec tout les bailleurs
    public function allBailleurs()
    {
        $bailleurUsers = User::where('role', 'bailleur')->get();

        return view('bailleur_views/allbailleurs', ['bailleurUsers' => $bailleurUsers]);
    }


    public function index()
    {
        $bailleurs = Bailleur::all();
        return response()->json($bailleurs);
    }

    public function edit(Bailleur $bailleur)
    {
        return view('bailleur_views.updatebailleur', compact('bailleur'));
    }

    public function update(Request $request, Bailleur $bailleur)
    {
        // Validation et mise à jour des données du bailleur
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:60',
            'rib' => 'required|string|max:60',
            'phone' => 'required|string|max:60',
            'email' => 'required|string|email|max:255',
            'birth_date' => 'required|date',
        ]);

        $bailleur->update($request->all());

        return redirect()->route('bailleurs.index')->with('success', 'Bailleur updated successfully.');
    }



    public function destroy(User $user)
    {
        $bailleur = $user->bailleur;
        $user->delete();

        if (!is_null($bailleur))
        {
            $bailleur->delete();
        }

        return redirect()->route('bailleur.index');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $bailleur_id = Auth::id();
        $biens = Bien::where('id_bailleur', $bailleur_id)->get();

        return view('bailleur/dashboard', compact('user', 'biens'));
    }

}
