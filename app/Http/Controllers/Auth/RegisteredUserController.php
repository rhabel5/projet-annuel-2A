<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'birthdate' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'tel' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
