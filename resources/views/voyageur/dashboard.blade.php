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

        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Réservations à venir</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($reservationsAVenir->isEmpty())
                    <p class="col-span-full text-center">Vous n'avez aucune réservation à venir.</p>
                @else
                    @foreach($reservationsAVenir as $reservation)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                            @if($reservation->bien && $reservation->bien->image_url)
                                <img class="w-full h-48 object-cover" src="{{ $reservation->bien->image_url }}" alt="{{ $reservation->bien->titre }}">
                            @endif
                            <div class="p-4">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $reservation->bien->titre }}</h2>
                                <p class="text-gray-700 dark:text-gray-300">{{ $reservation->bien->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Adresse:</strong> {{ $reservation->bien->adresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Date de début:</strong> {{ $reservation->date_debut }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Date de fin:</strong> {{ $reservation->date_fin }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <h3 class="text-2xl font-semibold mt-8 mb-4 text-gray-900 dark:text-gray-100">Réservations Passées</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($reservationsPassees->isEmpty())
                    <p class="col-span-full text-center">Vous n'avez aucune réservation passée.</p>
                @else
                    @foreach($reservationsPassees as $reservation)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                            @if($reservation->bien && $reservation->bien->image_url)
                                <img class="w-full h-48 object-cover" src="{{ $reservation->bien->image_url }}" alt="{{ $reservation->bien->titre }}">
                            @endif
                            <div class="p-4">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $reservation->bien->titre }}</h2>
                                <p class="text-gray-700 dark:text-gray-300">{{ $reservation->bien->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Adresse:</strong> {{ $reservation->bien->adresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Date de début:</strong> {{ $reservation->date_debut }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Date de fin:</strong> {{ $reservation->date_fin }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
