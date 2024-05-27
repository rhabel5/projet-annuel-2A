@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Backoffice</h1>
    <p class="text-gray-700 dark:text-gray-300">Bienvenue dans le backoffice.</p>
    <ul>
        <li><a href="{{ route('admin.users.index') }}">Gestion des utilisateurs</a></li>
        <li><a href="{{ route('admin.biens.index') }}">Gestion des biens</a></li>
        <li><a href="{{ route('admin.services.index') }}">Gestion des services</a></li>
        <li><a href="{{ route('admin.tickets.index') }}">Gestion des tickets</a></li>
    </ul>
</div>
@endsection