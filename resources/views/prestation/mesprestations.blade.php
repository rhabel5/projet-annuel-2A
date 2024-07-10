@php

    use \App\Models\Prestation;
     use \App\Models\TypePrestation;
     use App\Models\User;use Illuminate\Support\Facades\Auth;
     use Carbon\Carbon;

     $prestations = Prestation::where('state', 'a')->where('id_prestataire', Auth::id())->get();

     $now = Carbon::now();
     $prestations_avenir = $prestations->filter(function($prestation) use ($now) {
         return Carbon::parse($prestation->debut)->isAfter($now);
     });

     $prestations_cours = $prestations->filter(function($prestation) use ($now) {
         return Carbon::parse($prestation->debut)->isBefore($now) && Carbon::parse($prestation->fin)->isAfter($now);
     });

     $prestations_passees = $prestations->filter(function($prestation) use ($now) {
         return Carbon::parse($prestation->fin)->isBefore($now);
     });


@endphp
@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('Mes Prestations') }}</h2>

    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">
        <!-- Prestations à venir -->
        <h3 class="text-2xl font-semibold text-center text-blue-500 dark:text-blue-300 mb-8 transition duration-500 ease-in-out">{{ __('Prestations à venir') }}</h3>
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
            @if(!$prestations_avenir->isEmpty())
                @foreach($prestations_avenir as $prestation)
                    @php
                        $type = TypePrestation::find($prestation->type);
                        $nom = $type->nom;
                    @endphp
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div id="infos" class="flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->addresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    De {{ Carbon::parse($prestation->debut)->format('H:i') . ' le ' . Carbon::parse($prestation->debut)->format('d/m/Y') }}
                                    à {{ Carbon::parse($prestation->fin)->format('H:i') . ' le '.  Carbon::parse($prestation->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Indications : {{ $prestation->indications }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Rémunération : {{ $prestation->paye_presta }}</p>
                            </div>
                        </div>
                        <button
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800">
                            Annuler
                        </button>
                    </div>
                @endforeach
            @else
                <p class="text-center">Il n'y a aucune prestation à venir.</p>
            @endif
        </div>

        <!-- Prestations en cours -->
        <h3 class="text-2xl font-semibold text-center text-yellow-500 dark:text-yellow-300 mt-16 mb-8 transition duration-500 ease-in-out">{{ __('Prestations en cours') }}</h3>
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
            @if(!$prestations_cours->isEmpty())
                @foreach($prestations_cours as $prestation)
                    @php
                        $bailleur = User::find($prestation->id_bailleur);
                        $mailbailleur = $bailleur->email;
                        $type = TypePrestation::find($prestation->type);
                        $nom = $type->nom;
                    @endphp
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div id="infos" class="flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->addresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    De {{ Carbon::parse($prestation->debut)->format('H:i') . ' le ' . Carbon::parse($prestation->debut)->format('d/m/Y') }}
                                    à {{ Carbon::parse($prestation->fin)->format('H:i') . ' le '.  Carbon::parse($prestation->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Indications : {{ $prestation->indications }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Rémunération : {{ $prestation->paye_presta }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($prestation->addresse) }}"
                               target="_blank"
                               class="w-1/2 px-4 py-2 bg-indigo-600 text-white text-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 mr-2">Itinéraire</a>
                            <a href="mailto:{{ $mailbailleur }}?subject=Contact%20pour%20la%20prestation%20{{ $nom }}%20du%20{{Carbon::parse($prestation->debut)->format('d/m/Y')}}"
                               class="w-1/2 px-4 py-2 bg-indigo-600 text-white text-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 ml-2">
                                Contacter le bailleur
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Il n'y a aucune prestation en cours.</p>
            @endif
        </div>

        <!-- Prestations passées -->
        <h3 class="text-2xl font-semibold text-center text-gray-500 dark:text-gray-300 mt-16 mb-8 transition duration-500 ease-in-out">{{ __('Prestations passées') }}</h3>
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
            @if(!$prestations_passees->isEmpty())
                @foreach($prestations_passees as $prestation)
                    @php
                        $type = TypePrestation::find($prestation->type);
                        $nom = $type->nom;
                    @endphp
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div id="infos" class="flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->addresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    De {{ Carbon::parse($prestation->debut)->format('H:i') . ' le ' . Carbon::parse($prestation->debut)->format('d/m/Y') }}
                                    à {{ Carbon::parse($prestation->fin)->format('H:i') . ' le '.  Carbon::parse($prestation->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Indications : {{ $prestation->indications }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">
                                    Rémunération : {{ $prestation->paye_presta }}</p>
                            </div>
                        </div>
                        <form action="{{ route('validerPrestation', ['prestation' => $prestation]) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800">
                                Valider la prestation
                            </button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-center">Il n'y a aucune prestation passée.</p>
            @endif
        </div>
    </section>
@endsection

