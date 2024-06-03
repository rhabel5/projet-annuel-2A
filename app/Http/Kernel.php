<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\LanguageMiddleware::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        'log' => \App\Http\Middleware\LogRequests::class,
        'language' => \App\Http\Middleware\LanguageMiddleware::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}