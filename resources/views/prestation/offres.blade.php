@php

use \App\Models\Prestation;
use \App\Models\TypePrestation;
use Illuminate\Support\Facades\Auth;
  use Carbon\Carbon;
use App\Models\PrestaTypeMission;

$typesdepresta = PrestaTypeMission::where('user_id', Auth::id())->pluck('type_prestation_id');

$offres = Prestation::where('state', 'na')->whereIn('type', $typesdepresta)->get();



@endphp
@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('Offres') }}</h2>

    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
        @if(!$offres->isEmpty())
            @foreach($offres as $offre)
                @php
                    $type = TypePrestation::find($offre->type);
                    $nom = $type->nom;

                    $devisenvoyes = \App\Models\Devis::where('id_prestation', $offre->id)->whereNotNull('etat')->get();

                if ($offre->genre == 1) {
                    if($devisenvoyes->isEmpty()){
                        continue;
                    }
                }
                @endphp



                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div>
                            <!--<img src="{{ isset($offre->image_url) ? $offre->image_url : '' }}" alt="Image" class="h-40 w-full object-cover rounded-md mb-4 transition duration-500 ease-in-out">-->
                        </div>
                        <div id="infos" class="flex flex-col justify-between">
                            <div >
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $offre->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ explode(',', $offre->addresse)[1] }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">De {{ Carbon::parse($offre->debut)->format('H:i') . ' le ' . Carbon::parse($offre->debut)->format('d/m/Y') }} à {{ Carbon::parse($offre->fin)->format('H:i') . ' le '.  Carbon::parse($offre->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">Indications : {{ $offre->indications }}</p>
                                @if($offre->genre == 0)
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">Rémunération : {{ $offre->paye_presta }}</p>
                                @endif
                            </div>
                            @if($offre->genre == 0)
                                <div>
                                    <form action="{{ route('offres.accept', $offre) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800"> Accepter </button>
                                    </form>
                                </div>
                            @endif
                            @if($offre->genre == 1)
                                <div>
                                    <form action="{{ route('offres.devis', $offre) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800"> Proposer un devis</button>
                                    </form>
                                </div>
                            @endif


                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">Il n'y a pas d'offres à afficher.</p>
        @endif
    </section>
@endsection

