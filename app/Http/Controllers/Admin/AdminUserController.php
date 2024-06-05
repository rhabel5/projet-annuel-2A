<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only('firstname', 'lastname', 'email', 'tel', 'birthdate'));

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $user->roles()->sync($request->roles);
        
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'birthdate' => 'required|date',
            'password' => 'required|string|max:60',
            'tel' => 'required|string|max:60',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->roles()->attach($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }
}