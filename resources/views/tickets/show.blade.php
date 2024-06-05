@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">{{ $ticket->title }}</h1>
    <div class="bg-white shadow-md rounded-md p-6">
        <p class="mb-4">{{ $ticket->message }}</p>
        <p class="text-gray-700">Statut: {{ $ticket->status }}</p>
    </div>
</div>
@endsection