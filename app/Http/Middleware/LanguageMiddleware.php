<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info('LanguageMiddleware: Checking session for applocale'); // Log

        if (Session::has('applocale') && array_key_exists(Session::get('applocale'), config('languages'))) {
            $locale = Session::get('applocale');
            Log::info('LanguageMiddleware: Setting locale to ' . $locale); // Log
            App::setLocale($locale);
        } else {
            $defaultLocale = config('app.locale');
            Log::info('LanguageMiddleware: Setting locale to default ' . $defaultLocale); // Log
            App::setLocale($defaultLocale);
        }

        return $next($request);
    }
}