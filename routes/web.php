<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;

Route::get('/', [BienController::class, 'index'])->name('home');
Route::get('/biens/{bien}', [BienController::class, 'show'])->name('biens.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:voyageur'])->group(function () {
    Route::get('/voyageur/dashboard', function () {
        return view('voyageur.dashboard');
    })->name('voyageur.dashboard');
});

Route::middleware(['auth', 'role:prestataire'])->group(function () {
    Route::get('/prestataire/dashboard', function () {
        return view('prestataire.dashboard');
    })->name('prestataire.dashboard');
});

Route::middleware(['auth', 'role:bailleur'])->group(function () {
    Route::get('/bailleur/dashboard', function () {
        return view('bailleur.dashboard');
    })->name('bailleur.dashboard');
});

Route::get('/simulation', function () {
    return view('simulation');
})->name('simulation');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

require __DIR__.'/auth.php';