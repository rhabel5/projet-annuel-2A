<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiAuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
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
    Route::post('/', [BailleurController::class, 'store'])->name('api.bailleurs.store');
    Route::get('/', [BailleurController::class, 'index'])->name('api.bailleurs.index');
    Route::put('/{bailleur}', [BailleurController::class, 'update'])->name('api.bailleurs.update');
    Route::delete('/{bailleur}', [BailleurController::class, 'destroy'])->name('api.bailleurs.destroy');
});

// Routes pour les Biens
Route::prefix('biens')->group(function () {
    Route::post('/', [BienController::class, 'store'])->name('api.biens.store');
    Route::get('/', [BienController::class, 'index'])->name('api.biens.index');
    Route::put('/{bien}', [BienController::class, 'update'])->name('api.biens.update');
    Route::delete('/{bien}', [BienController::class, 'destroy'])->name('api.biens.destroy');
});


Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [ApiAuthenticatedSessionController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [ApiAuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Routes protégées pour les Utilisateurs
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('api.users.show');
    Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
    Route::get('/check', [UserController::class, 'isConnected'])->name('api.users.check');
});

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