<?php

require_once __DIR__ . "/../../database/connection.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/methodes_biens/addprorerty.php";
require_once __DIR__ . "/../../libraries/response.php";


$body = getBody();


$id_bailleur = $body["id_bailleur"];
$nom_bien = $body["nom_bien"];
$description = $body["description"];
$couchage = $body["couchage"];
$type_bien = $body["type_bien"];
$type_location = $body["type_location"];
$ville = $body["ville"];
$adresse = $body["adresse"];
$code_postal = $body["code_postal"];
$prix_adulte = $body["prix_adulte"];
$prix_enfant = $body["prix_enfant"];
$prix_animaux = $body["prix_animaux"];
$nb_lit = $body["nb_lit"];
$piscine = $body["piscine"];
$note_moyenne = $body["note_moyenne"];
$salle_eau = $body["salle_eau"];
$images = $body["images"];
$nb_chambres = $body["nb_chambres"];
$dispo = $body["dispo"];
$valide = $body["valide"];

if(empty($id_bailleur) || empty($nom_bien) || empty($adresse)) {
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
        'success' => false,
        'error' => 'Certaines informations obligatoires sont manquantes.'
    ]);
    die();
}

$ajoutBien = registerProperty($id_bailleur, $nom_bien, $description, $couchage, $type_bien, $type_location, $ville, $adresse, $code_postal, $prix_adulte, $prix_enfant, $prix_animaux, $nb_lit, $piscine, $note_moyenne, $salle_eau, $images, $nb_chambres, $dispo, $valide);

if ($ajoutBien) {
    echo jsonResponse(200, [], [
        'success' => true,
        'message' => "Bien ajouté avec succès."
    ]);
} else {
    echo jsonResponse(400, [], [
        'success' => false,
        'error' => 'Échec de l\'ajout du bien.'
    ]);
}
