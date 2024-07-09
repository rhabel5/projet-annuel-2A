@php use App\Models\Devis; use App\Models\Prestataire; use App\Models\Prestation; use App\Models\Reservation; use App\Models\User; @endphp
@php
    $prestatype = \App\Models\TypePrestation::find($prestation->type);
    $alldevis = Devis::where('id_prestation', $prestation->id )->get();
@endphp
@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto mt-12 px-4 py-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-md">
        <h1 class="text-2xl font-bold mb-6">Devis pour la prestation: {{$prestatype->nom}} du {{ \Carbon\Carbon::parse($prestation->debut)->format('d/m/Y') }}</h1>
        <div id="toutlesdevis" class="max-w-4xl mx-auto p-6">
            @if($alldevis->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">Aucun devis n'est disponible pour cette prestation.</p>
            @else
                @foreach($alldevis as $devis)
                    @php
                        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
                        $bailleur = User::find($devis->id_bailleur);
                        $reservation = Reservation::find($devis->id_reservation);
                        $offre = Prestation::find($devis->id_prestation);
                    @endphp
                    <div class="p-6 bg-white dark:bg-gray-700 shadow rounded-lg mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Devis n° {{$devis->id}}</p>
                                <p class="text-gray-600 dark:text-gray-300">Entreprise: {{$prestataire->nom_entreprise}}</p>
                                <p class="text-gray-600 dark:text-gray-300">Prix: {{$devis->prix_total}} €</p>
                            </div>
                            <div class="flex">
                                <form action="{{route('accepterdevis', ['devis' => $devis->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Accepter</button>
                                </form>
                                <form action="{{route('refuserdevis', ['devis' => $devis->id] )}}" method="POST">
                                    @csrf
                                    <button type="submit" class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Refuser</button>
                                </form>
                                <form action="{{ route('telechargerdevis', ['devis' => $devis->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Télécharger</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
