<!-- resources/views/bailleur/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Tableau de bord Voyageur</h1>
        <p class="text-gray-700 dark:text-gray-300">Bienvenue sur votre tableau de bord, {{ $user->firstname }} !</p>

        <!-- Barre de recherche -->
        <input type="text" id="search" placeholder="Rechercher des biens par titre" class="w-full p-2 mb-6 rounded-lg shadow-md">

        <!-- Conteneur des biens -->
        <div id="biens-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
            @foreach ($biens as $bien)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img class="w-full h-48 object-cover" src="{{ $bien->image_url ?? 'default-image-url.jpg' }}" alt="Image du logement">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-100">{{ $bien->titre }}</h2>
                        <p class="mt-2 text-gray-300">{{ $bien->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value.trim();

        if (query === '') {
            // Si la barre de recherche est vide, recharge la page pour afficher tous les biens
            window.location.reload();
        } else {
            // Si une recherche est effectuée, affiche les résultats filtrés
            fetch(`/bailleur/dashboard?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let biensContainer = document.getElementById('biens-container');
                    biensContainer.innerHTML = '';
                    data.forEach(bien => {
                        let bienElement = `
                            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                                <img class="w-full h-48 object-cover" src="${bien.image_url ?? 'default-image-url.jpg'}" alt="Image du logement">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold text-gray-100">${bien.titre}</h2>
                                    <p class="mt-2 text-gray-300">${bien.description}</p>
                                </div>
                            </div>
                        `;
                        biensContainer.innerHTML += bienElement;
                    });
                });
        }
    });
</script>
@endsection
