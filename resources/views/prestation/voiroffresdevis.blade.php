@php use App\Models\Devis; @endphp
@php

$alldevis = Devis::where('id_prestation', $offreId )->get();


@endphp

@foreach($alldevis as $devis)

    @php   print_r($devis);  @endphp

@endforeach
