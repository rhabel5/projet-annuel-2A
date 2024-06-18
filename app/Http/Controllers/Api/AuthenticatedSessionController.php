<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthenticatedSessionController extends Controller
{
    use HasApiTokens;

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;
    
        return response()->json([
            'token' => $token,
            'user' => $user,
            'redirect' => 'home'
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}