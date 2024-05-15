<?php

namespace App\Http\Controllers;

use App\Models\Bailleur; // Make sure you have a Bailleur model correctly set up
use App\Models\User;
use Illuminate\Http\Request;
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

    public function edit($id)
    {
        $bailleur = Bailleur::with('user')->findOrFail($id); // Assurez-vous que vous avez bien la relation avec 'user' configurée
        return view('updatebailleur', compact('bailleur'));
    }


    public function update(Request $request, Bailleur $bailleur): \Illuminate\Http\RedirectResponse
    {
        // validation des données reçues
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // et les autres règles de validation selon votre modèle de bailleur
        ]);

        // modification des données du bailleur
        $bailleur->name = $request->name;
        $bailleur->email = $request->email;
        // et les autres attributs de votre modèle de bailleur

        // sauvegarde des modifications
        $bailleur->save();

        // redirection vers la page appropriée avec un message de succès
        return redirect()->route('bailleurs.show', $bailleur)->with('success', 'Les informations du bailleur ont été modifiées avec succès');
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
}
