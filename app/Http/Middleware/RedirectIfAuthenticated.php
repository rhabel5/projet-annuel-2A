<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if ($user->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->hasRole('voyageur')) {
                    return redirect()->route('voyageur.dashboard');
                } elseif ($user->hasRole('bailleur')) {
                    return redirect()->route('bailleur.dashboard');
                } elseif ($user->hasRole('prestataire')) {
                    return redirect()->route('prestataire.dashboard');
                }

                return redirect('/home');
            }
        }

        return $next($request);
    }
}