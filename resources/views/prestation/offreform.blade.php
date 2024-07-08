@php

 $bien = \App\Models\Bien::find($reservation->id_bien);

 @endphp

@extends('layouts.app')
@section('content')

<div class="w-full max-w-xs mx-auto mt-6">
    <div class="flex flex-col justify-between ">
    <div class="flex  items-center justify-center" >
        <h1 class="text-2xl font-bold" > Poster une offre {{$typeprestation->nom}} </h1>
    </div>

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('offreform')}}">
        @csrf
        <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
            Bien
        </label>
        <input disabled value="{{$bien->titre}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="user_id" type="text" placeholder="UserID">

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="date">
            Du
        </label>
        <input name="debut" value="{{ Carbon\Carbon::parse($reservation->date_debut)->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="datetime-local" placeholder="Date">

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="date">
            Au
        </label>
        <input name="fin" value="{{ Carbon\Carbon::parse($reservation->date_fin)->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="datetime-local" placeholder="Date">
        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="prix">
            Prix
        </label>
        <input name="prix" value="{{$typeprestation->prix_moyen}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prix" type="number" placeholder="Prix">

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="adresse">
            Adresse
        </label>
        <!-- Supposons que $adresse est l'adresse du bien -->
        <input readonly name="addresse" value="{{$bien->adresse}}, {{$bien->code_postal}} {{$bien->ville}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="addresse" type="text" placeholder="Adresse">

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="description">
            Description
        </label>
        <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" rows="5" placeholder="Adresse">{{$typeprestation->description}}</textarea>

        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="description">
            Indications
        </label>

        <input type="hidden" name="id_reservation" value="{{$reservation->id}}">
        <input type="hidden" name="type_prestation" value="{{$typeprestation}}">
        <input type="hidden" name="type_prestation" value="{{$typeprestation}}">
        <input type="hidden" name="id_voyageur" value="{{$reservation->id_client}}">
        <input type="hidden" name="id_bailleur" value="{{Auth::id()}}">
        <input type="hidden" name="">

        <textarea name="indications" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="indications" rows="5" placeholder="Ajoutez des informations supplémentaires à destination du prestataire"></textarea>        <div class="flex items-center justify-center mt-4">
            <button class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">Poster</button>
        </div>
    </form>
    </div>
</div>
@endsection
