@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mb-4">Ajouter un bien</h2>
            <form id="step-form" method="POST" action="{{ route('biens.store') }}">
                @csrf

                <div id="step-1">
                    <div class="mb-4">
                        <label for="titre" class="block text-gray-700 dark:text-gray-200">{{ __('Nom du Bien') }}</label>
                        <input id="titre" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('titre') border-red-500 @enderror" name="titre" value="{{ old('titre') }}" required>
                        @error('titre')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-200">{{ __('Description') }}</label>
                        <textarea id="description" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('description') border-red-500 @enderror" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="couchage" class="block text-gray-700 dark:text-gray-200">{{ __('Couchage') }}</label>
                        <input id="couchage" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('couchage') border-red-500 @enderror" name="couchage" value="{{ old('couchage') }}" required>
                        @error('couchage')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <div id="step-2" style="display: none;">
                    <div class="mb-4">
                        <label for="type_bien" class="block text-gray-700 dark:text-gray-200">{{ __('Type de Bien') }}</label>
                        <select id="type_bien" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('type_bien') border-red-500 @enderror" name="type_bien" required>
                            <option value="appartement" {{ old('type_bien') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                            <option value="villa" {{ old('type_bien') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="studio" {{ old('type_bien') == 'studio' ? 'selected' : '' }}>Studio</option>
                            <option value="maison" {{ old('type_bien') == 'maison' ? 'selected' : '' }}>Maison</option>
                            <option value="duplex" {{ old('type_bien') == 'duplex' ? 'selected' : '' }}>Duplex</option>
                            <option value="manoir" {{ old('type_bien') == 'manoir' ? 'selected' : '' }}>Manoir</option>
                        </select>
                        @error('type_bien')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="adresse" class="block text-gray-700 dark:text-gray-200">{{ __('Adresse') }}</label>
                        <input id="adresse" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600" name="adresse" value="{{ old('adresse') }}" required>
                        @error('adresse')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="ville" class="block text-gray-700 dark:text-gray-200">{{ __('Ville') }}</label>
                        <input id="ville" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('ville') border-red-500 @enderror" name="ville" value="{{ old('ville') }}" required>
                        @error('ville')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="code_postal" class="block text-gray-700 dark:text-gray-200">{{ __('Code Postal') }}</label>
                        <input id="code_postal" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('code_postal') border-red-500 @enderror" name="code_postal" value="{{ old('code_postal') }}" required>
                        @error('code_postal')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <div id="step-3" style="display: none;">
                    <div class="mb-4">
                        <label for="prix_adulte" class="block text-gray-700 dark:text-gray-200">{{ __('Prix par Adulte') }}</label>
                        <input id="prix_adulte" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('prix_adulte') border-red-500 @enderror" name="prix_adulte" value="{{ old('prix_adulte') }}" required>
                        @error('prix_adulte')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="prix_enfant" class="block text-gray-700 dark:text-gray-200">{{ __('Prix par Enfant') }}</label>
                        <input id="prix_enfant" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('prix_enfant') border-red-500 @enderror" name="prix_enfant" value="{{ old('prix_enfant') }}" required>
                        @error('prix_enfant')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="prix_animaux" class="block text-gray-700 dark:text-gray-200">{{ __('Prix pour Animaux') }}</label>
                        <input id="prix_animaux" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('prix_animaux') border-red-500 @enderror" name="prix_animaux" value="{{ old('prix_animaux') }}" required>
                        @error('prix_animaux')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <div id="step-4" style="display: none;">
                    <div class="mb-4">
                        <label for="nb_lit" class="block text-gray-700 dark:text-gray-200">{{ __('Nombre de Lits') }}</label>
                        <input id="nb_lit" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('nb_lit') border-red-500 @enderror" name="nb_lit" value="{{ old('nb_lit') }}" required>
                        @error('nb_lit')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="piscine" class="block text-gray-700 dark:text-gray-200">{{ __('Piscine') }}</label>
                        <input id="piscine" type="checkbox" class="mt-1 block px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('piscine') border-red-500 @enderror" name="piscine" value="1" {{ old('piscine') ? 'checked' : '' }}>
                        @error('piscine')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="salle_eau" class="block text-gray-700 dark:text-gray-200">{{ __('Salle d\'Eau') }}</label>
                        <input id="salle_eau" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('salle_eau') border-red-500 @enderror" name="salle_eau" value="{{ old('salle_eau') }}" required>
                        @error('salle_eau')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="button" onclick="nextStep()">Suivant</button>
                </div>

                <div id="step-5" style="display: none;">
                    <div class="mb-4">
                        <label for="nb_chambres" class="block text-gray-700 dark:text-gray-200">{{ __('Nombre de Chambres') }}</label>
                        <input id="nb_chambres" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('nb_chambres') border-red-500 @enderror" name="nb_chambres" value="{{ old('nb_chambres') }}" required>
                        @error('nb_chambres')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="dispo" class="block text-gray-700 dark:text-gray-200">{{ __('Disponibilité') }}</label>
                        <input id="dispo" type="text" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:border-indigo-300 dark:focus:border-indigo-600 @error('dispo') border-red-500 @enderror" name="dispo" value="{{ old('dispo') }}" required>
                        @error('dispo')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <input id="id_bailleur" type="hidden" name="id_bailleur" value="{{ Auth::user()->id }}" required>
                    <button type="button" onclick="previousStep()">Précédent</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA38DEMSQDH82RNPROswWUs8jq9l62soCM&libraries=places"></script>
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

    function initAutocomplete() {
        var input = document.getElementById('adresse');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields(['address_components', 'geometry']);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Aucun détail disponible pour l'entrée : '" + place.name + "'");
                return;
            }

            var addressComponents = place.address_components;
            var postalCode = '';
            var ville = '';
            var numero = '';
            var rue = '';

            console.log(addressComponents);

            for (var i = 0; i < addressComponents.length; i++) {
                var component = addressComponents[i];
                if (component.types.includes('postal_code')) {
                    postalCode = component.long_name;
                    break;
                }
            }

                    component = addressComponents[2];
                    ville = component.long_name;
                    component = addressComponents[0]
                    numero = component.long_name
                    component = addressComponents[1]
                    rue = component.long_name

            var addresse = numero + ' ' + rue

            var postalCodeInput = document.getElementById('code_postal');
            postalCodeInput.value = postalCode;

            var villeInput = document.getElementById('ville');
            villeInput.value = ville;

            var addressseInput = document.getElementById('adresse');
            addressseInput.value = addresse;




            console.log(place);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initAutocomplete();
    });
</script>
