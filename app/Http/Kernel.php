<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RoleMiddleware;


class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
    ];

    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];

    // ...
}