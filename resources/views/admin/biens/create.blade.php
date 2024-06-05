@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Ajouter un nouveau bien</h1>
    <form method="POST" action="{{ route('admin.biens.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                <input type="text" id="titre" name="titre" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
            <div>
                <label for="couchage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Couchage</label>
                <input type="number" id="couchage" name="couchage" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="type_bien" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type de bien</label>
                <input type="text" id="type_bien" name="type_bien" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="type_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type de location</label>
                <input type="text" id="type_location" name="type_location" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="ville" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ville</label>
                <input type="text" id="ville" name="ville" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                <input type="text" id="adresse" name="adresse" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="code_postal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code postal</label>
                <input type="number" id="code_postal" name="code_postal" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="prix_adulte" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix par adulte</label>
                <input type="number" id="prix_adulte" name="prix_adulte" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="prix_enfant" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix par enfant</label>
                <input type="number" id="prix_enfant" name="prix_enfant" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="prix_animaux" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix par animal</label>
                <input type="number" id="prix_animaux" name="prix_animaux" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="nb_lit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de lits</label>
                <input type="number" id="nb_lit" name="nb_lit" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="piscine" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Piscine</label>
                <select id="piscine" name="piscine" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
            <div>
                <label for="salle_eau" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salle de bain</label>
                <input type="number" id="salle_eau" name="salle_eau" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL de l'image</label>
                <input type="text" id="image_url" name="image_url" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500" placeholder="http://example.com/image.jpg">
                <span class="text-gray-500 dark:text-gray-400">ou</span>
                <input type="file" id="image_file" name="image_file" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="nb_chambres" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de chambres</label>
                <input type="number" id="nb_chambres" name="nb_chambres" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="dispo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Disponibilité</label>
                <input type="number" id="dispo" name="dispo" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection