<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TicketController;

// Route par défaut
Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue dans l\'API']);
});

// Route de test pour vérifier le bon fonctionnement de l'API
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Routes pour les Bailleurs
Route::prefix('bailleurs')->group(function () {
    Route::post('/', [BailleurController::class, 'store'])->name('bailleurs.store');
    Route::get('/', [BailleurController::class, 'index'])->name('bailleurs.index');
    Route::put('/{bailleur}', [BailleurController::class, 'update'])->name('bailleurs.update');
    Route::delete('/{bailleur}', [BailleurController::class, 'destroy'])->name('bailleurs.destroy');
});

// Routes pour les Biens
Route::prefix('biens')->group(function () {
    Route::post('/', [BienController::class, 'store'])->name('api.biens.store'); // Renommé pour éviter les conflits
    Route::get('/', [BienController::class, 'index'])->name('api.biens.index');
    Route::put('/{bien}', [BienController::class, 'update'])->name('api.biens.update');
    Route::delete('/{bien}', [BienController::class, 'destroy'])->name('api.biens.destroy');
});

// Routes pour les Utilisateurs
Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('/check', [UserController::class, 'isConnected'])->name('users.check');
});

// Routes pour la connexion
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

// Routes pour les Tickets (protégées par auth:sanctum middleware)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('api.tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('api.tickets.show');
    Route::post('/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('api.tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('api.tickets.destroy');
    Route::put('/tickets/{ticket}/status', [TicketController::class, 'changeStatus'])->name('api.tickets.changeStatus');
    Route::post('/tickets/{ticket}/response', [TicketController::class, 'respond'])->name('api.tickets.respond');
});

// Route de test (duplication évitée en fusionnant les deux)
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});