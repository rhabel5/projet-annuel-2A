@php

    use App\Models\User;

      $client = User::find($reservation->id_client);
      $bien = \App\Models\Bien::find($reservation->id_bien);
      $dateDebut = \Carbon\Carbon::parse($reservation->date_debut);
    $dateFin = \Carbon\Carbon::parse($reservation->date_fin);
    $duree = $dateDebut->diffInDays($dateFin);

@endphp
@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.remove()">
                <title>Close</title>
                <path d="M14.348 5.652a.5.5 0 00-.707 0L10 9.293 6.359 5.652a.5.5 0 00-.707.707L9.293 10l-3.641 3.641a.5.5 0 00.707.707L10 10.707l3.641 3.641a.5.5 0 00.707-.707L10.707 10l3.641-3.641a.5.5 0 000-.707z"/>
            </svg>
        </span>
        </div>
    @endif

    <div class="flex items-center justify-center h-screen">
        <div class="container mx-auto px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-6">Reservation n°{{$reservation->id}}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <h1 class="text-xl font-bold mb-6">Réservation</h1>
                    <p class="mb-2"><strong>Du : {{ $dateDebut->format('d/m/Y') }} au {{ $dateFin->format('d/m/Y') }} </strong> </p>
                    <p class="mb-2"><strong> Durée : {{ $duree }} jours </strong> </p>
                </div>
                <div class="mb-4">
                    <h1 class="text-xl font-bold mb-6" >Bien</h1>
                    <p class="mb-2"><strong>{{ $bien->titre }}</strong> </p>
                    <p class="mb-2"><strong>{{ $bien->adresse . ' ' . $bien->code_postal . ' ' .  $bien->ville }}</strong> </p>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <a href="{{ route('reserver.get', [ 'bien' => $bien->id ]) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Modifier la reservation') }}
                </a>

                <a href="{{ route('offre.prestation', $reservation) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Ajouter une prestation') }}
                </a>
            </div>
        </div>
    </div>
@endsection
