@extends('layouts.app')
@section('content')
    @php
        use App\Models\Image;
        $images = Image::where('id_bien', $bien->id)->get();
    @endphp

    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">
        @if(!$bien)
            <p class="text-center text-gray-700 dark:text-gray-300">Le bien n'a pas été trouvé.</p>
        @else
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $bien->titre }}</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $bien->description }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Type de bien:</strong> {{ $bien->type_bien }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Type de location:</strong> {{ $bien->type_location }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Ville:</strong> {{ $bien->ville }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Adresse:</strong> {{ $bien->adresse }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Code Postal:</strong> {{ $bien->code_postal }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Prix Adulte:</strong> {{ $bien->prix_adulte }} €</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Prix Enfant:</strong> {{ $bien->prix_enfant }} €</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Prix Animaux:</strong> {{ $bien->prix_animaux }} €</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Nombre de lits:</strong> {{ $bien->nb_lit }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Piscine:</strong> {{ $bien->piscine ? 'Oui' : 'Non' }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Note Moyenne:</strong> {{ $bien->note_moyenne }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Salle(s) d'eau:</strong> {{ $bien->salle_eau }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Nombre de Chambres:</strong> {{ $bien->nb_chambres }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Disponibilité:</strong> {{ $bien->dispo ? 'Disponible' : 'Indisponible' }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Validation:</strong> {{ $bien->valide ? 'Validé' : 'Non Validé' }}</p>
                    </div>
                </div>

                <!-- Section des boutons -->
                <div class="flex justify-end mt-4">
                    <form action="{{ route('validerBien', ['bien' => $bien->id]) }}" method="POST" class="mr-2">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Valider le bien
                        </button>
                    </form>
                    <form action="{{ route('refuserBien', ['bien' => $bien->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Refuser
                        </button>
                    </form>
                </div>
            </div>
        @if($images->isEmpty())
                <p class="text-center text-gray-700 dark:text-gray-300 mt-4">Aucune image disponible pour ce bien.</p>
            @else
                <div class="row mt-4">
                    @foreach($images as $image)
                        <div class="col-md-3 mb-4">
                            <img src="{{ asset($image->chemin) }}" class="img-fluid" alt="Image {{ $loop->index + 1 }}">
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </section>
@endsection
