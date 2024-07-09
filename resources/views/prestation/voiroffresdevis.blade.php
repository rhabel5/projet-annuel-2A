@php use App\Models\Devis;use App\Models\Prestataire;use App\Models\Prestation;use App\Models\Reservation;use App\Models\User; @endphp
@php

    $prestatype = \App\Models\TypePrestation::find($prestation->type);
    $alldevis = Devis::where('id_prestation', $prestation->id )->get();

    //var_dump($alldevis);
@endphp
@extends('layouts.app')

@section('content')
<h1> Devis pour la prestation: {{$prestatype->nom}} du {{\Carbon\Carbon::parse($prestation->debut)->format('d/m/Y')}}</h1>
<div class="max-w-4xl mx-auto p-6">
@foreach($alldevis as $devis)
    @php
        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
        $bailleur = User::find($devis->id_bailleur);
        $reservation = Reservation::find($devis->id_reservation);
        $offre = Prestation::find($devis->id_prestation);

    @endphp
    <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <div>
                <p class="text-lg font-semibold">Devis n° {{$devis->id}}</p>
                <p class="text-gray-600">Entreprise: {{$prestataire->nom_entreprise}}</p>
                <p class="text-gray-600">Prix: {{$devis->prix_total}} €</p>
            </div>
            <div>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Accepter</button>
                <button class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Refuser</button>
                <form action="{{route('telechargerdevis', ['devis' => $devis])}}" method="POST" >
                @csrf
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Télécharger</button>
                </form>

            </div>
        </div>
    </div>


@endforeach
</div>
@endsection
