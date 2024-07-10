@extends('layouts.app')
@section('content')
    @php use App\Models\Bien;use App\Models\Image; @endphp
    @php

        $biensaverifier = Bien::where('valide', 0)->get();


    @endphp
    <section class="container mx-auto px-4 py-16 transition duration-500 ease-in-out">

        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8 transition duration-500 ease-in-out">{{ __('Liste des biens à vérifier') }}</h2>
        <div class="grid md:grid-cols-3 gap-8 transition duration-500 ease-in-out">

            @foreach($biensaverifier as $bien)

                @php

                    $images = Image::where('id_bien', $bien->id);

                @endphp
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition duration-500 ease-in-out">
                    <img src="{{ $bien->image_url }}" alt="Image du logement"
                         class="h-40 w-full object-cover rounded-md mb-4 transition duration-500 ease-in-out">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">{{ $bien->titre }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $bien->description }}</p>
                    <a href="{{ route('voirimagesbien', ['bien' => $bien->id]) }}"
                       class="text-blue-500 dark:text-blue-300 hover:underline mt-4 inline-block transition duration-500 ease-in-out">{{ __('messages.view_more') }}</a>
                </div>

            @endforeach
        </div>

    </section>
@endsection
