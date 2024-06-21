@extends('layouts.app')

@section('content')
@php

    use App\Models\TypePrestation;

    $typePrestations = TypePrestation::all();


@endphp

<div class="flex flex-col justify-center items-center min-h-screen">
    <div>
        <h1 class="text-center mb-4">Choisir le type de prestation</h1>

            @foreach ($typePrestations as $typePrestation)
                <div class="my-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="type_prestation[]" value="{{ $typePrestation->id }}">
                        <a href="{{route('offreform', ['typeprestation' => $typePrestation->id, 'reservation' => $reservation->id])}}">
                            <span class="ml-2">{{ $typePrestation->nom }} - {{ $typePrestation->description }} </span>
                        </a>
                    </label>
                </div>
            @endforeach
    </div>
</div>
@endsection
