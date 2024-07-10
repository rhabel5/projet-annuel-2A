@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Utilisateurs</h2>
            <p class="text-3xl">{{ $userCount }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Tickets</h2>
            <p class="text-3xl">{{ $ticketCount }}</p>
        </div>
        <div class="bg-pink-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Biens à Valider</h2>
            <p class="text-3xl">{{ $biensToValidateCount }}</p>
            <a href="{{ route('admin.biens.index') }}" class="mt-4 px-4 py-2 bg-pink-700 text-white rounded">Voir les Biens</a>
        </div>
    </div>
@endsection