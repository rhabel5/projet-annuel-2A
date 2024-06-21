@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Créer un Ticket</h1>
    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" id="title" name="title" required class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea id="message" name="message" required class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>
        <div class="mb-4">
            <label for="priority" class="block text-sm font-medium text-gray-700">Priorité</label>
            <select id="priority" name="priority" required class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="low">Basse</option>
                <option value="medium">Moyenne</option>
                <option value="high">Haute</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <select id="tags" name="tags[]" multiple class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Créer</button>
        </div>
    </form>
</div>
@endsection
