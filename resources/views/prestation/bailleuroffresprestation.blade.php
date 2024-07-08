@php

    use App\Models\Bien;use \App\Models\Prestation;
    use \App\Models\TypePrestation;
    use App\Models\User;use Illuminate\Support\Facades\Auth;
      use Carbon\Carbon;
    use App\Models\PrestaTypeMission;
    use \App\Models\Bailleur;
    use \App\Models\Reservation;
    $bailleur = User::find(Auth::id());
    $offres = Prestation::where('genre', '1')->where('id_bailleur', $bailleur->id)->where('state', 'na')->get();





@endphp
@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('Offres') }}</h2>

    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
        @if(!$offres->isEmpty())
            @foreach($offres as $offre)
                @php
                        $reservation = Reservation::find($offre->id_reservation);
                        $type = TypePrestation::find($offre->type);
                        $nom = $type->nom;
                        $bien = Bien::find($reservation->id_bien)
                @endphp
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div>
                            <!--<img src="{{ isset($offre->image_url) ? $offre->image_url : '' }}" alt="Image" class="h-40 w-full object-cover rounded-md mb-4 transition duration-500 ease-in-out">-->
                        </div>
                        <div id="infos" class="flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <h4 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $bien->titre . ' '. $bien->adresse }}</h4>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $offre->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ explode(',', $offre->addresse)[1] }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    De {{ Carbon::parse($offre->debut)->format('H:i') . ' le ' . Carbon::parse($offre->debut)->format('d/m/Y') }}
                                    à {{ Carbon::parse($offre->fin)->format('H:i') . ' le '.  Carbon::parse($offre->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Indications : {{ $offre->indications }}</p>
                            </div>
                            @if($offre->genre == 1)
                                <div>
                                    <form action="{{ route('voir.offres.devis', ['offre' => $offre->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800">
                                            Voir les devis
                                        </button>
                                    </form>
                                </div>
                            @endif


                        </div>
                    </div>
                    @endforeach
                    @else
                        <p class="text-center">Vous n'avez pas encore publier d'offre.</p>
                @endif
    </section>
@endsection
