@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html>
<head>
    <title>Formulaire avec Autocomplétion d'Adresse</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA38DEMSQDH82RNPROswWUs8jq9l62soCM&libraries=places"></script>
    <script>
        function initAutocomplete() {
            // Créez le champ d'entrée pour l'autocomplétion
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            // Limitez les résultats aux adresses
            autocomplete.setFields(['address_components', 'geometry']);

            // Écoutez les changements dans le champ d'entrée
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // L'utilisateur n'a pas sélectionné de résultat
                    window.alert("Aucun détail disponible pour l'entrée : '" + place.name + "'");
                    return;
                }
                // Affichez les détails du lieu dans la console (ou faites quelque chose avec)
                console.log(place);
            });
        }
    </script>
</head>
<body onload="initAutocomplete()">
<form method="POST" action="">
    @csrf
    <label for="autocomplete">Adresse :</label>
    <input id="autocomplete" type="text" name="address" />
    <button type="submit">Envoyer</button>
</form>
</body>
</html>

@endsection
