@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-6">Gestion des Devis</h1>
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.devis.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Ajouter un devis
        </a>
    </div>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-4 py-2">ID Prestataire</th>
                <th class="px-4 py-2">ID Bailleur</th>
                <th class="px-4 py-2">ID Réservation</th>
                <th class="px-4 py-2">ID Prestation</th>
                <th class="px-4 py-2">Prix Total</th>
                <th class="px-4 py-2">État</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devis as $devisItem)
            <tr class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                <td class="px-4 py-2">{{ $devisItem->id_prestataire }}</td>
                <td class="px-4 py-2">{{ $devisItem->id_bailleur }}</td>
                <td class="px-4 py-2">{{ $devisItem->id_reservation }}</td>
                <td class="px-4 py-2">{{ $devisItem->id_prestation }}</td>
                <td class="px-4 py-2">{{ $devisItem->prix_total }}</td>
                <td class="px-4 py-2">{{ $devisItem->etat }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.devis.edit', $devisItem->id) }}" class="text-blue-500 dark:text-blue-300 hover:underline">
                        Modifier
                    </a>
                    <form action="{{ route('admin.devis.destroy', $devisItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 dark:text-red-300 hover:underline ml-2">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
