@extends('layouts.admin')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="bg-orange-500 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
        <h1 class="text-white text-2xl font-semibold px-4">PCS Backoffice</h1>
        <nav>
            <a href="{{ route('users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-orange-700 hover:text-white text-white">Utilisateurs</a>
            <a href="{{ route('biens.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-orange-700 hover:text-white text-white">Biens</a>
            <a href="{{ route('comments.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-orange-700 hover:text-white text-white">Commentaires</a>
            <a href="{{ route('tickets.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-orange-700 hover:text-white text-white">Tickets</a>
            <a href="{{ route('maintenance.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-orange-700 hover:text-white text-white">En Maintenance</a>
        </nav>
    </div>

    <!-- Content Area -->
    <div class="flex-1 p-10 text-2xl font-bold">
        Bienvenue dans votre backoffice, gérez tout ici!
    </div>
</div>
@endsection