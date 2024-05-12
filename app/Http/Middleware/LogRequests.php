<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        Log::info('Requête entrante', ['url' => $request->url(), 'params' => $request->all()]);
        
        $response = $next($request);
    
        Log::info('Réponse sortante', ['url' => $request->url(), 'status' => $response->status()]);
    
        return $response;
    }    
}
