<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('admin.roles.index', compact('users', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->roles()->sync([$role->id]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role assigned successfully.');
    }
}