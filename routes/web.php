<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/properties', 'PropertyController@index')->name('properties.index');
Route::get('/properties/{property}', 'PropertyController@show')->name('properties.show');
Route::get('/properties/create', 'PropertyController@create')->name('properties.create');
Route::get('/properties/{property}/edit', 'PropertyController@edit')->name('properties.edit');

require __DIR__.'/auth.php';