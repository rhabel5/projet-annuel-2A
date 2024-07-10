<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\AuthenticatedSessionController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiReservationController;

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
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Routes protégées pour les Utilisateurs
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('api.users.show');
    Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');

    Route::get('/check', [UserController::class, 'isConnected'])->name('api.users.check');
    Route::get('/check-role', [AuthenticatedSessionController::class, 'checkRole'])->name('api.users.role');

    Route::get('/user', [AuthenticatedSessionController::class, 'getUser'])->name('api.users.user');
});

// Routes pour les Tickets (protégées par auth:sanctum middleware)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('api.tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('api.tickets.show');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('api.tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('api.tickets.destroy');
    Route::put('/tickets/{ticket}/status', [TicketController::class, 'changeStatus'])->name('api.tickets.changeStatus');
    Route::post('/tickets/{ticket}/response', [TicketController::class, 'respond'])->name('api.tickets.respond');
    Route::put('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('api.tickets.assign');
    Route::get('/tickets/{ticket}/responses', [TicketController::class, 'getResponses'])->name('api.tickets.responses');
    Route::get('/tickets/{ticket}/tags', [TicketController::class, 'getTags'])->name('api.tickets.tags');
    Route::post('/tickets/search', [TicketController::class, 'search'])->name('api.tickets.search');
});


// Routes for retrieving Android reservations
Route::post('/login', [ApiLoginController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{userId}/reservations', [ApiReservationController::class, 'getUserReservations']);
    });

    Route::prefix('reservations')->group(function () {
        Route::get('/', [ApiReservationController::class, 'getAllReservations']);
        Route::post('/', [ApiReservationController::class, 'store']);
        Route::get('/{reservationId}', [ApiReservationController::class, 'getReservation']);
        Route::put('/{reservationId}', [ApiReservationController::class, 'update']);
        Route::delete('/{reservationId}', [ApiReservationController::class, 'destroy']);
        Route::get('/{reservationId}/biens', [ApiReservationController::class, 'getReservationBiens']);
        Route::get('/{reservationId}/tickets', [ApiReservationController::class, 'getReservationTickets']);
        Route::get('/{reservationId}/facture', [ApiReservationController::class, 'getReservationFacture']);
        Route::get('/{reservationId}/paiements', [ApiReservationController::class, 'getReservationPaiements']);
        Route::post('/{reservationId}/paiements', [ApiReservationController::class, 'storePaiement']);
        Route::get('/{reservationId}/paiements/{paiementId}', [ApiReservationController::class, 'getPaiement']);
        Route::put('/{reservationId}/paiements/{paiementId}', [ApiReservationController::class, 'updatePaiement']);
        Route::delete('/{reservationId}/paiements/{paiementId}', [ApiReservationController::class, 'destroyPaiement']);
        Route::get('/{reservationId}/paiements/{paiementId}/facture', [ApiReservationController::class, 'getPaiementFacture']);
        Route::get('/{reservationId}/paiements/{paiementId}/tickets', [ApiReservationController::class, 'getPaiementTickets']);
        Route::get('/{reservationId}/paiements/{paiementId}/biens', [ApiReservationController::class, 'getPaiementBiens']);
        Route::get('/{reservationId}/paiements/{paiementId}/reservation', [ApiReservationController::class, 'getPaiementReservation']);
        Route::get('/{reservationId}/paiements/{paiementId}/user', [ApiReservationController::class, 'getPaiementUser']);
        Route::get('/{reservationId}/paiements/{paiementId}/bailleur', [ApiReservationController::class, 'getPaiementBailleur']);
    });
});