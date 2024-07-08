@php use App\Models\Devis; @endphp
@php


echo $id_offre;
$alldevis = Devis::where('id_prestation', $id_offre )->get();

var_dump($alldevis);
@endphp

@foreach($alldevis as $devis)

    @php   print_r($devis);  @endphp

@endforeach
