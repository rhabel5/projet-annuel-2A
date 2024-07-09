@php use App\Models\Devis;use App\Models\Prestataire;use App\Models\Prestation;use App\Models\Reservation;use App\Models\User; @endphp
@php


    echo $prestation;
    $alldevis = Devis::where('id_prestation', $prestation->id )->get();

    var_dump($alldevis);
@endphp

@foreach($alldevis as $devis)
    @php
        $prestataire = Prestataire::where('id_prestataire', $devis->id_prestataire)->first();
        $bailleur = User::find($devis->id_bailleur);
        $reservation = Reservation::find($devis->id_reservation);
        $offre = Prestation::find($devis->id_prestation);
    @endphp
@endforeach
