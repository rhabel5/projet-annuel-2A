@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mb-4">Ajouter un bien</h2>
            <form id="step-form" method="POST" action="{{ route('biens.store') }}">
                @csrf
                <div id="step-1">
                    <div class="mb-4">
                        <label for="nom_bien" class="block text-gray-700 dark:text-gray-200">{{ __('Donnez un nom à votre bien') }}</label>
                        <input id="nom_bien" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('nom_bien')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="Type de Bien" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="Type de Bien" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('Type de Bien') border-red-500 @enderror" name="Type de Bien" value="{{ old('Type de Bien') }}" required>
                        @error('Type de Bien')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="Description" class="block text-gray-700 dark:text-gray-200">{{ __('Description')}}</label>
                        <input id="Description" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('Description') border-red-500 @enderror" name="Description" value="{{ old('Description') }}" required>
                        @error('Description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <div id="step-2" style="display: none;">
                    <div class="mb-4">
                        <label for="adresse" class="block text-gray-700 dark:text-gray-200">{{ __('Adresse') }}</label>
                        <input id="adresse" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('adresse') border-red-500 @enderror" name="adresse" value="{{ old('adresse') }}" required>
                        @error('adresse')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="lastname" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="lastname" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <!-- Ajoutez plus d'étapes comme vous en avez besoin -->

                <div id="final-step" style="display: none;">
                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="lastname" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="lastname" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200">{{ __('Last Name') }}</label>
                        <input id="lastname" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>


        </div>
    </div>
@endsection
<script>
    let currentStep = 1;

    function nextStep() {
        document.getElementById('step-' + currentStep).style.display = 'none';
        currentStep++;
        document.getElementById('step-' + currentStep).style.display = 'block';
    }

    function previousStep() {
        document.getElementById('step-' + currentStep).style.display = 'none';
        currentStep--;
        document.getElementById('step-' + currentStep).style.display = 'block';
    }
</script>
