@php
    use App\Models\User;use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('content')


<h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('messages.mes_reservations') }}</h2>
<div class="flex">
        @php
            $reservations = \App\Models\Reservation::where('id_bailleur', Auth::id())->get();
        @endphp

        @foreach ($reservations as $reservation)
            @php
                $user_id = Auth::id();
                $bien = \App\Models\Bien::find($reservation->id_bien);
                $client = User::find($reservation->id_client);
                $bailleur = User::find($reservation->id_bailleur);
                $dateDebut = \Carbon\Carbon::parse($reservation->date_debut)->toFormattedDateString();
                $dateFin = \Carbon\Carbon::parse($reservation->date_fin)->toFormattedDateString();
            @endphp
<!-- Faire une partie en cours, à venir et passées -->
            @if ($bien)
    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">

            <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                    <div>
                        <img src="{{ isset($bien->image_url) ? $bien->image_url : '' }}" alt="Image du logement"
                             class="h-40 w-full object-cover rounded-md mb-4 transition duration-500 ease-in-out">
                    </div>
                    <div id="infos" class="flex">
                        <div id="infobien">
                            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $bien->titre }}</h3>
                            <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $bien->description }}</p>
                            <a href="{{ route('reservation.get', $reservation) }}"
                               class="text-blue-500 dark:text-blue-300 hover:underline mt-4 inline-block transition duration-500 ease-in-out"> Details</a>
                        </div>
                        <div id="infobailleur">
                            <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out"> Par {{ $client->lastname  }}</p>
                            <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out"> Du {{ $dateDebut }} au {{$dateFin}} </p>
                            <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out"> Revenu : {{ $reservation->prix_total  }}</p>
                            <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out"> Nombre de voyageurs:  {{ $reservation->nb_adulte}}</p>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>
</div>
            @endif

        @endforeach

@endsection
