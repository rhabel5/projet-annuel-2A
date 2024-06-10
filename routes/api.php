<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TicketController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Routes for Bailleurs
Route::prefix('bailleurs')->group(function () {
    Route::post('/', [BailleurController::class, 'store'])->name('bailleurs.store');
    Route::get('/', [BailleurController::class, 'index'])->name('bailleurs.index');
    Route::put('/{bailleur}', [BailleurController::class, 'update'])->name('bailleurs.update');
    Route::delete('/{bailleur}', [BailleurController::class, 'destroy'])->name('bailleurs.destroy');
});

// Routes for Biens
Route::prefix('biens')->group(function () {
    Route::post('/', [BienController::class, 'store'])->name('biens.store');
    Route::get('/', [BienController::class, 'index'])->name('biens.index');
    Route::put('/{bien}', [BienController::class, 'update'])->name('biens.update');
    Route::delete('/{bien}', [BienController::class, 'destroy'])->name('biens.destroy');
});

// Routes for Users
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

// Routes for login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

//Ticket

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
    Route::put('/tickets/{ticket}/status', [TicketController::class, 'changeStatus']);
    Route::post('/tickets/{ticket}/response', [TicketController::class, 'respond']);
});