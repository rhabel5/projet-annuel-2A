<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    // Méthode pour afficher la page d'accueil du backoffice
    public function index()
    {
        return view('admin.index');
    }

    // Méthode pour gérer la création d'un nouvel élément dans le backoffice
    public function create()
    {
        return view('admin.create');
    }

    // Méthode pour gérer l'édition d'un élément existant dans le backoffice
    public function edit($id)
    {
        $element = Element::find($id);
        return view('admin.edit', compact('element'));
    }

    // Méthode pour gérer la suppression d'un élément dans le backoffice
    public function delete($id)
    {
        $element = Element::find($id);
        $element->delete();
        return redirect()->route('admin.index')->with('success', 'Element deleted successfully');
    }

    // Méthode pour gérer l'affichage des détails d'un élément dans le backoffice
    public function show($id)
    {
        $element = Element::find($id);
        return view('admin.show', compact('element'));
    }

    // Méthode pour lister les utilisateurs dans le backoffice
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Méthode pour afficher le formulaire de création d'un utilisateur
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Méthode pour gérer la création d'un utilisateur
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index');
    }

    // Méthode pour afficher le formulaire d'édition d'un utilisateur
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Méthode pour gérer la mise à jour d'un utilisateur
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:6|confirmed',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index');
    }

    // Méthode pour gérer la suppression d'un utilisateur
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}