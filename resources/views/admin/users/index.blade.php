@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-6">Gestion des Utilisateurs</h1>
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.users.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Ajouter un utilisateur
        </a>
    </div>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-4 py-2">Prénom</th>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Date de Naissance</th>
                <th class="px-4 py-2">Rôles</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                <td class="px-4 py-2">{{ $user->firstname }}</td>
                <td class="px-4 py-2">{{ $user->lastname }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}</td>
                <td class="px-4 py-2">
                    @foreach($user->roles as $role)
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                            @if($role->name == 'admin') 
                                bg-red-500 text-white 
                            @elseif($role->name == 'voyageur') 
                                bg-blue-500 text-white 
                            @elseif($role->name == 'bailleur') 
                                bg-teal-500 text-white 
                            @elseif($role->name == 'prestataire') 
                                bg-green-500 text-white 
                            @endif">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 dark:text-blue-300 hover:underline">
                        Modifier
                    </a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
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