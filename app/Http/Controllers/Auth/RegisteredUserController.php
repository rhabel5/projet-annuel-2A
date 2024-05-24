<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'birthdate' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'tel' => 'required|string|max:60',
            'role' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            'password' => Hash::make($request->input('password')),
            'tel' => $request->input('tel'),
            'role' => $request->input('role'),
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}