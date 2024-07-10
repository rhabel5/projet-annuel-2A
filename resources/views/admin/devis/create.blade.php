@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-6">Ajouter un Devis</h1>
    <form action="{{ route('admin.devis.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="id_prestataire" class="block text-sm font-medium text-gray-700">ID Prestataire</label>
            <input type="number" name="id_prestataire" id="id_prestataire" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="id_bailleur" class="block text-sm font-medium text-gray-700">ID Bailleur</label>
            <input type="number" name="id_bailleur" id="id_bailleur" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="id_reservation" class="block text-sm font-medium text-gray-700">ID Réservation</label>
            <input type="number" name="id_reservation" id="id_reservation" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="id_prestation" class="block text-sm font-medium text-gray-700">ID Prestation</label>
            <input type="number" name="id_prestation" id="id_prestation" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="prix_total" class="block text-sm font-medium text-gray-700">Prix Total</label>
            <input type="number" step="0.01" name="prix_total" id="prix_total" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="etat" class="block text-sm font-medium text-gray-700">État</label>
            <input type="text" name="etat" id="etat" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mt-6">
            <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Ajouter</button>
        </div>
    </form>
</div>
@endsection