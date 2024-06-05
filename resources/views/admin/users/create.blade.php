@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Ajouter un nouvel utilisateur</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="firstname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                <input type="text" id="firstname" name="firstname" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                <input type="text" id="lastname" name="lastname" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="tel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                <input type="tel" id="tel" name="tel" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de naissance</label>
                <input type="date" id="birthdate" name="birthdate" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="roles" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rôles</label>
                <div class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 p-4">
                    @foreach($roles as $role)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" class="mr-2">
                            <label for="role-{{ $role->id }}" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection