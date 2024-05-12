<?php

namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
    ];

    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
    ];

    // ...
}