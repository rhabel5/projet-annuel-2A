<!-- resources/views/voyageur/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Tableau de bord Voyageur</h1>
        <p class="text-gray-700 dark:text-gray-300">Bienvenue sur votre tableau de bord, {{ Auth::user()->firstname }} !</p>
    </div>
</div>
@endsection