<?php

use App\Http\Controllers\BailleurController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoyageurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/simulation', function () {
    return view('simulation');
})->name('simulation');

Route::get('/biens', [BienController::class, 'index']);
Route::post('/biens', [BienController::class, 'store']);
Route::put('/biens/{bien}', [BienController::class, 'update']);
Route::delete('/biens/{bien}', [BienController::class, 'destroy']);

// Routes pour l'administration
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
});

// Routes pour l'administration des utilisateurs
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('users', 'AdminController@listUsers')->name('admin.users.index');
    Route::get('users/create', 'AdminController@createUser')->name('admin.users.create');
    Route::post('users', 'AdminController@storeUser')->name('admin.users.store');
    Route::get('users/{user}/edit', 'AdminController@editUser')->name('admin.users.edit');
    Route::put('users/{user}', 'AdminController@updateUser')->name('admin.users.update');
    Route::delete('users/{user}', 'AdminController@destroyUser')->name('admin.users.destroy');
});

   //Routes Bailleurs
Route::get('users/create-bailleur', [UserController::class, 'createBailleur'])->name('users.create-bailleur');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('/allbailleurs', [BailleurController::class, 'allBailleurs']);
Route::delete('/bailleur/{user}', [BailleurController::class, 'destroy'])->name('bailleur.destroy');

Route::get('/bailleur/{id}/edit', [BailleurController::class, 'edit'])->name('bailleur.edit');
//Route::post('/bailleur/{id}/update', 'BailleurController@update')->name('bailleur.update');


//Routes Voyageurs
Route::get('users/create-voyageur', [UserController::class, 'createVoyageur'])->name('users.create-voyageur');
Route::get('/allvoyageurs', [VoyageurController::class, 'allVoyageurs'])->name('allvoyageurs');
Route::post('/registervoyageur', [UserController::class, 'registerVoyageur']);
Route::get('voyageur/{voyageur}/edit', [VoyageurController::class, 'allVoyageurs'])->name('voyageur.edit');
Route::delete('voyageur/{voyageur}', [VoyageurController::class, 'allVoyageurs'])->name('voyageur.destroy');


//Routes Presta
Route::get('/allprestataires', [PrestataireController::class, 'allPrestataires'])->name('allprestataires');
Route::get('inscription/prestataire', [UserController::class, 'createPrestataire'])->name('inscription/prestataire');
require __DIR__.'/auth.php';
