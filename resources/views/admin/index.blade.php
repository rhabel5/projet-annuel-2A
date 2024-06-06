@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="bg-red-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Erreurs PHP</h2>
            <p class="text-3xl">3</p>
            <button class="mt-4 px-4 py-2 bg-red-700 rounded">Détails</button>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Mails Systèmes</h2>
            <p class="text-3xl">0</p>
            <button class="mt-4 px-4 py-2 bg-green-700 rounded">Détails</button>
        </div>
        <div class="bg-orange-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Failles Potentielles</h2>
            <p class="text-3xl">964</p>
            <button class="mt-4 px-4 py-2 bg-orange-700 rounded">Détails</button>
        </div>
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Contrôles Opérationnels</h2>
            <p class="text-3xl">100%</p>
            <button class="mt-4 px-4 py-2 bg-blue-700 rounded">Détails</button>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tickets à Traiter</h3>
            <p class="text-3xl text-red-500">1</p>
            <button class="mt-4 px-4 py-2 bg-red-700 text-white rounded">Détails</button>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Alarms Actives</h3>
            <p class="text-3xl text-red-500">13</p>
            <button class="mt-4 px-4 py-2 bg-red-700 text-white rounded">Détails</button>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-4 mt-4 rounded-lg shadow">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Messages Systèmes</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="py-2 px-4 border-b">Serveur</th>
                        <th class="py-2 px-4 border-b">Source</th>
                        <th class="py-2 px-4 border-b">Horodatage</th>
                        <th class="py-2 px-4 border-b">Détails</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-300">
                    <!-- Exemples de lignes -->
                    <tr>
                        <td class="py-2 px-4 border-b">HELENE</td>
                        <td class="py-2 px-4 border-b">CONSOLE</td>
                        <td class="py-2 px-4 border-b">2024-12-31 01:04:15</td>
                        <td class="py-2 px-4 border-b">Erreur de connexion à la base de données</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection