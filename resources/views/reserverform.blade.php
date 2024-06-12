@extends('layouts.app')
<div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Réserver Votre Séjour
            </h2>
        </div>
        <form method="POST" action="/route-to-handle-the-form" class="mt-8 space-y-6">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="date_debut" class="">Date Début</label>
                    <input type="date" id="date_debut" name="date_debut" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>
                <div>
                    <label for="date_fin" class="">Date Fin</label>
                    <input type="date" id="date_fin" name="date_fin" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>
                <div>
                    <label for="nombre_adultes" class="">Nombre d'Adultes</label>
                    <input type="number" id="nombre_adultes" name="nombre_adultes" min="1" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>
                <div>
                    <label for="nombre_enfants" class="">Nombre d'Enfants</label>
                    <input type="number" id="nombre_enfants" name="nombre_enfants" min="0" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>
                <div>
                    <label for="nombre_animaux" class="">Nombre d'animaux de companie</label>
                    <input type="number" id="nombre_animaux" name="nombre_animaux" min="0" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>

                <input type="hidden" value="{{ $bien }}">
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            </span>
                    Reserver
                </button>
            </div>
        </form>
    </div>
</div>
