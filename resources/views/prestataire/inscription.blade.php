@extends('layouts.app')
@php
    use App\Models\TypePrestation;
    $typePrestations = TypePrestation::all();
@endphp
@section('content')
<div class="flex flex-col justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Inscription Prestataire</h1>

        <form id="multiStepForm" action="{{ route('prestataire.inscription') }}" method="POST">
            @csrf
            <!-- Étape 1 : Informations sur l'entreprise -->
            <div class="step">
                <h2 class="text-xl font-semibold text-center mb-4">Étape 1 : Informations sur l'entreprise</h2>
                <div class="mb-4">
                    <label class="block text-gray-700">Nom de l’entreprise</label>
                    <input type="text" name="nom_entreprise" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Adresse de l’entreprise</label>
                    <input type="text" name="adresse_entreprise" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Titulaire du compte</label>
                    <input type="text" name="titulaire_compte" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Adresse de facturation (ville code postal pays)</label>
                    <input type="text" name="adresse_facturation" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">IBAN</label>
                    <input type="text" name="iban" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">BIC</label>
                    <input type="text" name="bic" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <button type="button" class="nextStep w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Suivant</button>
            </div>
            <!-- Étape 2 : Type de prestations -->
            <div class="step hidden">
                <h2 class="text-xl font-semibold text-center mb-4">Étape 2 : Choisir vos types de prestations</h2>
                @foreach ($typePrestations as $typePrestation)
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="type_prestation[]" value="{{ $typePrestation->id }}" class="form-checkbox text-blue-500">
                            <span class="ml-2 text-gray-700">{{ $typePrestation->nom }} - {{ $typePrestation->description }} - Prérequis : {{ $typePrestation->prerequis }}</span>
                        </label>
                    </div>
                @endforeach
                <div class="flex justify-between">
                    <button type="button" class="prevStep w-full mr-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-200">Précédent</button>
                    <input type="submit" value="Soumettre" class="w-full ml-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.nextStep');
        const prevButtons = document.querySelectorAll('.prevStep');
        let currentStep = 0;

        function showStep(step) {
            steps.forEach((stepElement, index) => {
                stepElement.classList.toggle('hidden', index !== step);
            });
        }

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentStep++;
                showStep(currentStep);
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentStep--;
                showStep(currentStep);
            });
        });

        showStep(currentStep);
    });
</script>
