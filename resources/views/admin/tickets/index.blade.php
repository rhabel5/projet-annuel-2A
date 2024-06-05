@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Gestion des Tickets</h1>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Utilisateur</th>
                <th class="px-4 py-2">Titre</th>
                <th class="px-4 py-2">Message</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr class="bg-gray-100 border-b">
                <td class="px-4 py-2">{{ $ticket->user->firstname }} {{ $ticket->user->lastname }}</td>
                <td class="px-4 py-2">{{ $ticket->title }}</td>
                <td class="px-4 py-2">{{ Str::limit($ticket->message, 50) }}</td>
                <td class="px-4 py-2">{{ $ticket->status }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection