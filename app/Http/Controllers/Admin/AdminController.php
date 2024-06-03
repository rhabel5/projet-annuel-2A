<?php

namespace App\Http\Controllers\Admin;

use App\Models\Element;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function edit($id)
    {
        $element = Element::find($id);
        return view('admin.edit', compact('element'));
    }

    public function delete($id)
    {
        $element = Element::find($id);
        $element->delete();
        return redirect()->route('admin.index')->with('success', 'Element deleted successfully');
    }

    public function show($id)
    {
        $element = Element::find($id);
        return view('admin.show', compact('element'));
    }

    public function listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

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

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

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

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}