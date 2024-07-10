@php use App\Models\Devis;use App\Models\Prestataire;use App\Models\Prestation;use App\Models\Reservation;use App\Models\User;use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')
@php

    $devisenattente =  Devis::where('id_prestataire', Auth::id())->where('etat', 'envoye')->get();

@endphp
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div
        class="container mx-auto mt-12 px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
        <h1 class="text-2xl font-bold mb-6">Mes devis en attente</h1>
        <div id="toutlesdevis" class="max-w-4xl mx-auto p-6">
            @if($devisenattente->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">Vous n'avez aucun devis en attente.</p>
            @else
                @foreach($devisenattente as $devis)
                    @php
                        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
                        $bailleur = User::find($devis->id_bailleur);
                        $reservation = Reservation::find($devis->id_reservation);
                        $offre = Prestation::find($devis->id_prestation);
                    @endphp
                    <div class="p-6 bg-white dark:bg-gray-700 shadow rounded-lg mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Devis
                                    n° {{$devis->id}}</p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Pour: {{$bailleur->fisrtname . ' ' . $bailleur->lastname}}</p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Adresse: {{$offre->addresse}}</p>
                                <p class="text-gray-600 dark:text-gray-300">Prix: {{$devis->prix_total}} €</p>
                            </div>
                            <div class="flex justify-between">
                                <form action="{{route('supprimeroffredevis', ['devis' => $devis->id] )}}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Supprimer mon offre
                                    </button>
                                </form>
                                <form action="{{ route('telechargerdevis', ['devis' => $devis->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        Télécharger
                                    </button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection



