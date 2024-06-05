@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Mes Tickets</h1>
    <div class="mb-4">
        <a href="{{ route('tickets.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer un Ticket</a>
    </div>
    <table class="table-auto w-full text-left">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Titre</th>
                <th class="px-4 py-2">Message</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">{{ $ticket->title }}</td>
                    <td class="px-4 py-2">{{ Str::limit($ticket->message, 50) }}</td>
                    <td class="px-4 py-2">{{ $ticket->status }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center">Aucun ticket trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection