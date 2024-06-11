<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Vérifiez si l'application est en mode maintenance
if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

// Enregistre l'autoloader de Composer
require __DIR__.'/../vendor/autoload.php';

// Démarre Laravel et traite la requête
$app = require_once __DIR__.'/../bootstrap/app.php';

// Crée une instance de Kernel
$kernel = $app->make(Kernel::class);

// Traite la requête entrante et envoie la réponse
$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);