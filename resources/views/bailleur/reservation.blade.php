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
                    <p class="mb-2"><strong>{{ $bien->adresse . $bien->code_postal .  $bien->ville }}</strong> </p>
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
