@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-6">Gestion des Biens</h1>
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.biens.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">Ajouter un bien</a>
    </div>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Titre</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Ville</th>
                <th class="px-4 py-2">Valide</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($biens as $bien)
            <tr class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                <td class="px-4 py-2">
                    @if($bien->image_url)
                        <img src="{{ $bien->image_url }}" alt="{{ $bien->titre }}" class="w-16 h-16 object-cover rounded-md">
                    @else
                        <span class="text-gray-500">Pas d'image</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $bien->titre }}</td>
                <td class="px-4 py-2">{{ Str::limit($bien->description, 50) }}</td>
                <td class="px-4 py-2">{{ $bien->ville }}</td>
                <td class="px-4 py-2">
                    @if($bien->valide)
                        <span class="text-green-500">Validé</span>
                    @else
                        <span class="text-red-500">En attente</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.biens.edit', $bien->id) }}" class="text-blue-500 dark:text-blue-300 hover:underline">Modifier</a>
                    <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 dark:text-red-300 hover:underline ml-2">Supprimer</button>
                    </form>
                    @if(!$bien->valide)
                        <form action="{{ route('admin.biens.validate', $bien->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-500 dark:text-green-300 hover:underline ml-2">Valider</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection