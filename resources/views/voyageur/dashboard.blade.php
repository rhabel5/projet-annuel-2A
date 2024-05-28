<!-- resources/views/voyageur/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Tableau de bord Voyageur</h1>
        <p class="text-gray-700 dark:text-gray-300">Bienvenue sur votre tableau de bord, {{ $user->firstname }} !</p>

        <!-- Informations de profil -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Informations du Profil</h2>
            <form action="{{ route('voyageur.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300" for="firstname">Prénom</label>
                    <input class="w-full p-2 border border-gray-300 rounded mt-1" type="text" name="firstname" id="firstname" value="{{ $user->firstname }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300" for="lastname">Nom</label>
                    <input class="w-full p-2 border border-gray-300 rounded mt-1" type="text" name="lastname" id="lastname" value="{{ $user->lastname }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300" for="email">Email</label>
                    <input class="w-full p-2 border border-gray-300 rounded mt-1" type="email" name="email" id="email" value="{{ $user->email }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300" for="birthdate">Date de naissance</label>
                    <input class="w-full p-2 border border-gray-300 rounded mt-1" type="date" name="birthdate" id="birthdate" value="{{ $user->birthdate }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300" for="tel">Téléphone</label>
                    <input class="w-full p-2 border border-gray-300 rounded mt-1" type="text" name="tel" id="tel" value="{{ $user->tel }}">
                </div>
                <div>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded" type="submit">Mettre à jour</button>
                </div>
            </form>
        </div>

        <!-- Réservations à venir -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Mes séjours à venir</h2>
            @if($reservationsAVenir->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">Pas de séjours à venir.</p>
            @else
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    @foreach($reservationsAVenir as $reservation)
                        <li>{{ $reservation->bien->nom_bien }} - du {{ $reservation->date_debut }} au {{ $reservation->date_fin }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Réservations passées -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Mes séjours précédents</h2>
            @if($reservationsPassees->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">Pas de séjours précédents.</p>
            @else
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    @foreach($reservationsPassees as $reservation)
                        <li>{{ $reservation->bien->nom_bien }} - du {{ $reservation->date_debut }} au {{ $reservation->date_fin }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
