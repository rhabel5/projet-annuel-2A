<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerBailleur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'tel' => ['required', 'string', 'max:255'],
            'naissance' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'rib' => ['required', 'string', 'max:255'],

        ]);

        echo "hello from registerBailleur";

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'naissance' => $request->naissance,
            'role' => $request->role,
            'tel' => $request->tel,
        ]);

        $bailleurFields = [
            'user_id' => $user->id,
            'nom' => $user->nom . ' ' . $user->prenom,
            'rib' => $request->rib,
            'role'=> 'bailleur'
        ];

        Bailleur::create($bailleurFields);

        //$user->role = $request->invitation_code === 'quoicoubeh' ? 'admin' : 'user';
        //$user->save();

        //return $user->role === 'admin' ?
            //redirect()->route('admin.dashboard') :
            //redirect('/home');

        return response()->json(['user' => $user, 'message' => 'Created successfully'], 201);
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
}
