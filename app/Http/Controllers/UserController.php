<?php

namespace App\Http\Controllers;

use App\Models\Role_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createVoyageur()
    {
        return view('voyageur_views.addvoyageurs');
    }

    public function createBailleur()
    {
        return view('bailleur_views.addbailleur');
    }

    public function createPrestataire()
    {
        return view('presta_views.addpresta');
    }

    public function store(Request $request)
    {

        $rules = [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'birth_date' => 'required|date',
            'password' => 'required|string|max:60',
            'phone' => 'required|string|max:60',
        ];

        // Common rules based on role

        $data = $request->validate($rules);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        //return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function checkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function isConnected()
    {
        return response()->json(['isConnected' => Auth::check()]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Auth::user()->role === 'admin' ?
                redirect()->route('admin.dashboard') :
                redirect('/home');
        }

        return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
    }

    public function edit(User $user)
    {
        switch ($user->role) {
            case 'voyageur':
                return view('voyageurs_views.edit-voyageur', compact('user'));
            case 'bailleur':
                return view('bailleur_views.edit-bailleur', compact('user'));
            case 'prestataire':
                return view('users_views.edit-prestataire', compact('user'));
            default:
                return redirect()->route('users.index')->withErrors(['role' => 'Invalid role specified.']);
        }
    }


    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update($request->all());
        return response()->json(['user' => $user, 'message' => 'Updated successfully']);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function assignRole($idRole, $idUser)
    {
        $data = [
            'id_user' => $idUser,
            'id_role' => $idRole,
        ];


        Role_user::create($data);
    }

}
