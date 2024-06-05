@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">{{ $ticket->title }}</h1>
    <div class="bg-white shadow-md rounded-md p-6">
        <p class="mb-4">{{ $ticket->message }}</p>
        <p class="text-gray-700">Utilisateur: {{ $ticket->user->firstname }} {{ $ticket->user->lastname }}</p>
        <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Ouvert</option>
                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Fermé</option>
                </select>
            </div>
            <div class="mt-6">
                <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection