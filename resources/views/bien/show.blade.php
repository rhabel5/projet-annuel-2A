@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center h-screen">
    <div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-6">{{ $bien->titre }}</h1>
            <img src="{{ $bien->image_url }}" alt="Image du logement" class="h-80 w-full object-cover rounded-md mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <p class="mb-2"><strong>{{ __('Ville:') }}</strong> {{ $bien->ville }}</p>
                    <p class="mb-2"><strong>{{ __('Prix par adulte:') }}</strong> {{ $bien->prix_adulte }}€</p>
                    <p class="mb-2"><strong>{{ __('Prix par enfant:') }}</strong> {{ $bien->prix_enfant }}€</p>
                    <p class="mb-2"><strong>{{ __('Prix par animaux:') }}</strong> {{ $bien->prix_animaux }}€</p>
                    <p class="mb-2"><strong>{{ __('Nombre de lits:') }}</strong> {{ $bien->nb_lit }}</p>
                </div>
                <div class="mb-4">
                    <p class="mb-2"><strong>{{ __('Piscine:') }}</strong> {{ $bien->piscine ? 'Oui' : 'Non' }}</p>
                    <p class="mb-2"><strong>{{ __('Note moyenne:') }}</strong> {{ $bien->note_moyenne }}</p>
                    <p class="mb-2"><strong>{{ __('Salle d\'eau:') }}</strong> {{ $bien->salle_eau }}</p>
                    <p class="mb-2"><strong>{{ __('Nombre de chambres:') }}</strong> {{ $bien->nb_chambres }}</p>
                    <p class="mb-2"><strong>{{ __('Disponible:') }}</strong> {{ $bien->dispo ? 'Oui' : 'Non' }}</p>
                    <p class="mb-2"><strong>{{ __('Validé:') }}</strong> {{ $bien->valide ? 'Oui' : 'Non' }}</p>
                </div>
        </div>
        <div class="mt-6 flex justify-between">
            <a href="{{ route('home') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">{{ __('Retour à l\'accueil') }}</a>
            <a href="{{ route('reserver.get', ['bien' => $bien]) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">{{ __('Réserver') }}</a>
        </div>
    </div>
</div>
@endsection
