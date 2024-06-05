@extends('layouts.app')

@section('content')
    <section class="bg-cover bg-center h-screen text-white flex items-center justify-center filter brightness-100 dark:brightness-75" style="background-image: url('{{ asset('images/exemple.webp') }}');">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h1 class="text-5xl font-bold mb-4">{{ __('messages.welcome') }}</h1>
            <p class="text-2xl">{{ __('messages.manage_properties') }}</p>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">{{ __('messages.services') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.checkin_checkout') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.checkin_checkout_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.cleaning') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.cleaning_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.maintenance') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.maintenance_desc') }}</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">{{ __('messages.our_properties') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($biens as $bien)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ $bien->image_url }}" alt="Image du logement" class="h-40 w-full object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $bien->titre }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $bien->description }}</p>
                    <a href="{{ route('biens.show', $bien) }}" class="text-blue-500 dark:text-blue-300 hover:underline mt-4 inline-block">{{ __('messages.view_more') }}</a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-700 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-red-500 dark:text-red-300 mb-4">{{ __('messages.estimate_income') }}</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-8">{{ __('messages.use_simulator') }}</p>
            <a href="{{ route('simulation') }}" class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-400 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">{{ __('messages.start_simulation') }}</a>
        </div>
    </section>
@endsection