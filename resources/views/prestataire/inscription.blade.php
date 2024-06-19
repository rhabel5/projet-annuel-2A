@php

    use App\Models\TypePrestation;

    $typePrestations = TypePrestation::all();

@endphp

<form action="/route-ou-traiter-le-formulaire" method="POST">
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
