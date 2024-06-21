@php

    use \App\Models\Prestation;
    use \App\Models\TypePrestation;
    use Illuminate\Support\Facades\Auth;
      use Carbon\Carbon;
    use App\Models\PrestaTypeMission;


    $prestations = Prestation::where('state', 'a')->where('id_prestataire', Auth::id())->get();



@endphp
@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('Mes Prestations') }}</h2>

    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">
        @if(!$prestations->isEmpty())
            @foreach($prestations as $prestation)
                @php
                    $type = TypePrestation::find($prestation->type);
                    $nom = $type->nom;
                    //$bailleur = \App\Models\Bailleur::find($prestation->)
                @endphp
                <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                        <div>
                            <!--<img src="{{ isset($prestation->image_url) ? $prestation->image_url : '' }}" alt="Image" class="h-40 w-full object-cover rounded-md mb-4 transition duration-500 ease-in-out">-->
                        </div>
                        <div id="infos" class="flex flex-col justify-between">
                            <div >
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $nom }}</h3>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $prestation->addresse }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">De {{ Carbon::parse($prestation->debut)->format('H:i') . ' le ' . Carbon::parse($prestation->debut)->format('d/m/Y') }} à {{ Carbon::parse($prestation->fin)->format('H:i') . ' le '.  Carbon::parse($prestation->fin)->format('d/m/Y') }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">Indications : {{ $prestation->indications }}</p>
                                <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">Rémunération : {{ $prestation->paye_presta }}</p>
                            </div>
                        </div>

                        <button class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800" >Information Bailleurs</button>
                    </div>
                    @endforeach
                    @else
                        <p class="text-center">Il n'y a aucune prestation à afficher.</p>
                @endif
    </section>
@endsection

