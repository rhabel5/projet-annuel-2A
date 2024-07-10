@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-6">Gestion des Prestations</h1>
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.prestations.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">Ajouter une Prestation</a>
    </div>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Début</th>
                <th class="px-4 py-2">Fin</th>
                <th class="px-4 py-2">Prix</th>
                <th class="px-4 py-2">Adresse</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestations as $prestation)
            <tr class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                <td class="px-4 py-2">{{ $prestation->type_prestation }}</td>
                <td class="px-4 py-2">{{ $prestation->debut }}</td>
                <td class="px-4 py-2">{{ $prestation->fin }}</td>
                <td class="px-4 py-2">{{ $prestation->prix }}</td>
                <td class="px-4 py-2">{{ $prestation->addresse }}</td>
                <td class="px-4 py-2">{{ Str::limit($prestation->description, 50) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.prestations.edit', $prestation->id) }}" class="text-blue-500 dark:text-blue-300 hover:underline">Modifier</a>
                    <form action="{{ route('admin.prestations.destroy', $prestation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 dark:text-red-300 hover:underline ml-2">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection