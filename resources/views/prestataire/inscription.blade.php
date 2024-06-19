@extends('layouts.app')
@php

    use App\Models\TypePrestation;

    $typePrestations = TypePrestation::all();

@endphp

<div class="flex flex-col justify-center items-center min-h-screen">
    <div>
        <h1 class="text-center mb-4">Choisir vos type de prestations</h1>

        <form action="{{route('prestataire.inscription')}}" method="POST">
            @csrf
            @foreach ($typePrestations as $typePrestation)
                <div class="my-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="type_prestation[]" value="{{ $typePrestation->id }}">
                        <span class="ml-2">{{ $typePrestation->nom }} - {{ $typePrestation->description }} - Prérequis : {{ $typePrestation->prerequis }}</span>
                    </label>
                </div>
            @endforeach

            <input type="submit" value="Soumettre" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded shadow">
        </form>
    </div>
</div>
