<?php

use App\Http\Controllers\DevisController;
use App\Http\Controllers\FicheInterventionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\PrestationTypeController;
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
    Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
    Route::get('/botman/widget', [BotManController::class, 'widget']);
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
    Route::put('/admin/biens/{id}/validate', [AdminBienController::class, 'validateBien'])->name('admin.biens.validate');
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
Route::get('/bien/ajout', function () {
    return view('biens_views/addbien');
})->name('biens.create_view');

//test api siren
Route::get('/siren', function () {
    return view('siren_api');
});

//Routes biens
Route::post('/biens/ajout', [BienController::class, 'store'])->name('biens.create_store');

Route::get('/bien/{bien}/ajout_equipement', [BienController::class, 'show'])->name('biens.equipement');

Route::get('/equipements/create', [EquipementsController::class, 'create'])->middleware('auth')->name('equipements.create');
Route::post('/equipements', [EquipementsController::class, 'store'])->middleware('auth')->name('equipements.store');
Route::get('/equipements/selection', [EquipementsController::class, 'select'])->middleware('auth')->name('equipements.select');
Route::post('/equipements/selection', [EquipementsController::class, 'postselect'])->middleware('auth')->name('equipements.postselect');

require __DIR__.'/auth.php';

// Route dashboard voyageur (Retirer les duplications)
Route::middleware(['auth'])->group(function () {
    Route::get('/voyageur/dashboard', [VoyageurController::class, 'dashboard'])->name('voyageur.dashboard');
    Route::put('/voyageur/update', [VoyageurController::class, 'update'])->name('voyageur.update');
});

// Route dashboard bailleur
Route::get('bailleur/dashboard', [BailleurController::class, 'dashboard'])->middleware('auth')->name('bailleur.dashboard');

//-------------------------------------------------Route Réservation----------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('reserver/{bien}', [ReservationController::class, 'reserverform'])->middleware('auth')->name('reserver.get');
Route::post('reserver/{bien}', [ReservationController::class, 'reserver'])->middleware('auth')->name('reserver.post');
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//----------------------------------------------------Route payement (pas fonctionel)------------------------------------------------------------------------------------------------------------------------------------
Route::get('payementreservation/{reservation}', [ReservationController::class, 'formulairepayement'])->middleware('auth')->name('formulairepayement');
Route::get('processpayement/{reservation}', [ReservationController::class, 'processpayement'])->middleware('auth')->name('processpayement');
Route::get('payementsuccess/{reservation}', [ReservationController::class, 'payementsuccess'])->middleware('auth')->name('payementsuccess');
Route::get('payementcancel/{reservation}', [ReservationController::class, 'payementcancel'])->middleware('auth')->name('payementcancel');

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//---------------------------------???Route pour voir une reservation ????----------------------------------------------------------------------------------------------------------------------
Route::get('reservation/{reservation}', [ReservationController::class, 'reservation'])->middleware('auth')->name('reservation.get');
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//---------------------------------------------Routes pour que les Bailleurs puissent voir leurs biens et leurs reservations -------------------------------------------------------------------------
Route::get('mesbiens.blade.php', [BienController::class, 'mesbiens'])->middleware('auth')->name('mesbiens');
Route::get('mesreservations', [ReservationController::class, 'mesreservations'])->middleware('auth')->name('mesreservations');
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------Routes Inscription Prestataires-------------------------------------------------------------------------------------------------------------------------------
Route::get('prestataire/inscritpion', [PrestataireController::class, 'inscription'])->middleware('auth')->name('prestataire.inscription');
Route::post('prestataire/inscritpion', [PrestataireController::class, 'create'])->middleware('auth')->name('prestataire.inscription');
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------------------Ajout des types prestatations-----------------------------------------------------------------------------------------------------------------------------
Route::get('prestataire/mestypesdeprestations', [PrestataireController::class, 'showtypespresta'])->middleware('auth')->name('prestation.mestypesprestations');
Route::post('prestataire/modifstypespresta', [PrestataireController::class, 'modifstypespresta'])->middleware('auth')->name('prestataire.modifstypespresta');
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------------Route pour que l'admin puisse ajouter des types de prestation---------------------------------------------------------------------------------------------
Route::get('prestation/type/ajout', [PrestationTypeController::class, 'form'])->middleware('auth')->name('prestation.type');
Route::post('prestation/type/ajout', [PrestationTypeController::class, 'store'])->middleware('auth')->name('prestation.type.post');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//------------------------------Routes prestataire pour la visualisation des offres et l'acceptation de celles-ci---------------------------------------------------------------------------------------
Route::get('prestations', [PrestationController::class, 'prestationsOffres'])->middleware('auth')->name('prestation.offres');
Route::post('/prestation/{prestation}/accept', [PrestationController::class, 'offresaccept'])->name('offres.accept');
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//-----------------------------------------Route pour que le prestataire puisse voir les prestations qu'il a acceptées-----------------------------------------------------------------------------------------
Route::get('mesprestations', [PrestationController::class, 'mesprestations'])->middleware('auth')->name('prestation.mesprestations');
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//------------------------------------------Route pour que le bailleur puisse voir les offres qu'il a publiées-----------------------------------------------------------------------------------------------------
Route::get('bailleur/mesoffres', [PrestationController::class, 'mesoffresprestations'])->middleware('auth')->name('mesoffresprestations');
//----------------------------------------------------------------------------------------------------------------------------------------------------------

//----------------------------------Route pour voir les devis qu'il a reçu pour une offre, accepter et refuser une offre--------------------------------------------------------------------------------------------------------
Route::post('bailleur/devis/{prestation}', [PrestationController::class, 'voiroffresdevis'])->middleware('auth')->name('voir.offres.devis');


//------------------------------------------------------------Route pour accepter ou refuser  une offre----------------------------------------------------------------------------------
Route::post('bailleur/devis/{devis}/accept', [PrestationController::class, 'accepter'])->middleware('auth')->name('accepterdevis');
Route::post('bailleur/devis/{devis}/refuser', [PrestationController::class, 'refuserdevis'])->middleware('auth')->name('refuserdevis');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//---------------------------------Renvoie le formulaire pour qu'un prestataire puisse créer un devis et ses éléments------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/prestation/{prestation}/devis', [PrestationController::class, 'offresdevis'])->name('offres.devis');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//----------------------------Routes pour que le prestataire puisse créer un devis, le visualiser et l'envoyer-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/deviscreate', [DevisController::class, 'create'])->middleware('auth')->name('deviscreate');
//
Route::post('/devis/pdf/{devis}/{download}', [DevisController::class, 'devispdf'])->middleware('auth')->name('envoiedevis');
//Telecharger le devis
Route::post('/devis/telecharger/{devis}/', [DevisController::class, 'telechargerdevis'])->middleware('auth')->name('telechargerdevis');
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//-------------------------------------------Route pour visualiser la liste des devis envoye et les gérer----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('mesdevis', [DevisController::class, 'devisenattente'])->middleware('auth')->name('devisenattente');
Route::post('supprimeroffredevis/{devis}', [PrestationController::class, 'supprimeroffredevis'])->middleware('auth')->name('supprimeroffredevis');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//------------------------------------------------Route pour Ajouter une prestation à une reservation-----------------------------------------------------------------------------------------------------------------------------
//Choisir le type de la prestation à ajouter
Route::get('prestation/choix/{reservation}', [PrestationController::class, 'offreprestation'])->middleware('auth')->name('offre.prestation');

//Formulaire pour remplir les détails de la prestation (date, prix, description etc)
Route::get('prestation/{typeprestation}/{reservation}', [PrestationController::class, 'offreform'])->middleware('auth')->name('offregetform');

//Créer la prestation
Route::post('prestation/', [PrestationController::class, 'create'])->middleware('auth')->name('offreform');
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//------------------------------------------------------Routes recherche de bien (pas fonctionel) --------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/biens/search', [BienController::class, 'searchbien'])->name('biens.search');
Route::get('/apagnan', [BienController::class, 'searchbienview'])->name('biens.search');
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//------------------------------------Route presta pour valider une prestation----------------------------------------------------------------------------------------------------------------------------------------
Route::post('/valider/{prestation}', [PrestationController::class, 'validerPrestation'])->name('validerPrestation');
Route::post('/fiche/intervention/', [FicheInterventionController::class, 'store'])->name('ficheintervention.post');



//----------------------------------------------Ajout d'image pour un bien---------------------------------------------------------------------------------
Route::get('/ajout/image/{bien}', [BienController::class, 'ajoutImageForm'])->name('ajoutImageForm');
Route::post('/ajout/image/{bien}', [\App\Http\Controllers\ImageController::class, 'store'])->name('ajoutImage');
Route::get('/voir/images/{bien}', [ImageController::class, 'voirimagesbien'])->name('voirimagesbien');

Route::get('/bienverif', [BienController::class, 'bienverif'])->name('bienverif');

Route::post('/validerBien', [BienController::class, 'validerBien'])->name('validerBien');
Route::post('/refuserBien', [BienController::class, 'refuserBien'])->name('refuserBien');


//-------------------------------Routes pour formulaire post prestation----------------------------------------------------------------------------------------------------




