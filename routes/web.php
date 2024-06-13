<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBienController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\VoyageurController;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\EquipementsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\VIPController;


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
});

Route::get('/', [BienController::class, 'index'])->name('home');
Route::get('/biens/{bien}', [BienController::class, 'show'])->name('biens.show');

//User
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Biens
    Route::resource('biens', BienController::class);
});

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
Route::get('/simulation', function () {
    return view('simulation');
})->name('simulation');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Backoffice users management
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Backoffice biens management
    Route::get('/admin/biens', [AdminBienController::class, 'index'])->name('admin.biens.index');
    Route::get('/admin/biens/create', [AdminBienController::class, 'create'])->name('admin.biens.create');
    Route::post('/admin/biens', [AdminBienController::class, 'store'])->name('admin.biens.store');
    Route::get('/admin/biens/{bien}/edit', [AdminBienController::class, 'edit'])->name('admin.biens.edit');
    Route::put('/admin/biens/{bien}', [AdminBienController::class, 'update'])->name('admin.biens.update');
    Route::delete('/admin/biens/{bien}', [AdminBienController::class, 'destroy'])->name('admin.biens.destroy');

    // Backoffice services management
    Route::get('/admin/services', [AdminServiceController::class, 'index'])->name('admin.services.index');

    // Backoffice tickets management
    Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::put('/admin/tickets/{ticket}', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
});

Route::middleware(['auth', 'role:voyageur'])->group(function () {
    Route::get('/voyageur/dashboard', [VoyageurController::class, 'dashboard'])->name('voyageur.dashboard');
    Route::get('/vip/subscription', function () {
        return view('vip.subscription');
    })->name('vip.subscription');
    Route::post('/vip/subscribe', [VIPController::class, 'subscribe'])->name('vip.subscribe');
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

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Routes biens
Route::get('/biens/ajout', function () {
    return view('biens_views/addbien');
})->name('biens.ajout');

// Evitez les duplications
Route::get('/bien_add', function () {
    return view('biens_views/addbien');
})->name('biens.create_view');

Route::post('/biens/ajout', [BienController::class, 'store'])->name('biens.create_store');

Route::get('/bien/{bien}/ajout_equipement', [BienController::class, 'show'])->name('biens.equipement');

Route::get('/equipements/create', [EquipementsController::class, 'create'])->name('equipements.create');
Route::post('/equipements', [EquipementsController::class, 'store'])->name('equipements.store');
Route::get('/equipements/selection', [EquipementsController::class, 'select'])->name('equipements.select');
Route::post('/equipements/selection', [EquipementsController::class, 'postselect'])->name('equipements.postselect');

require __DIR__.'/auth.php';

// Route dashboard voyageur (Retirer les duplications)
Route::middleware(['auth'])->group(function () {
    Route::get('/voyageur/dashboard', [VoyageurController::class, 'dashboard'])->name('voyageur.dashboard');
    Route::put('/voyageur/update', [VoyageurController::class, 'update'])->name('voyageur.update');
});

// Route dashboard bailleur
Route::get('bailleur/dashboard', [BailleurController::class, 'dashboard'])->middleware('auth')->name('bailleur.dashboard');

//Route Réservation

Route::get('reserver/{bien}', [ReservationController::class, 'reserverform'])->middleware('auth')->name('reserver.get');
Route::post('reserver/{bien}', [ReservationController::class, 'reserver'])->middleware('auth')->name('reserver.post');


//Routes Bailleurs

Route::get('mesbiens.blade.php', [BienController::class, 'mesbiens'])->middleware('auth')->name('mesbiens');
Route::get('mesreservations', [ReservationController::class, 'mesreservations'])->middleware('auth')->name('mesreservations');
