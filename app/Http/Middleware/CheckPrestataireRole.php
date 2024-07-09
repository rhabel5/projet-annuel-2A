<?php
namespace App\Http\Middleware;

use App\Models\Role_user;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPrestataireRole
{
public function handle(Request $request, Closure $next)
    {
            // Vérifier si l'utilisateur est authentifié
                if (Auth::check()) {
                    $user = Auth::user();
                    $hasrolepresta = Role_user::where('role_id', 4)->where('user_id', $user->id)->get();


                    if ($hasrolepresta->count() > 0) {
                    return $next($request);
                    }
                }

        // Rediriger ou retourner une réponse si l'utilisateur n'a pas le rôle de prestataire
        return redirect('/')->with('error', 'Vous n\'avez pas accès à cette page.');
        }
    }
