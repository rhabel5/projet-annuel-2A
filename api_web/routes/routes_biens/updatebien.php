<?php

require_once __DIR__ . "/../../database/connection.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/methodes_biens/updatebien.php";
require_once __DIR__ . "/../../libraries/response.php";

//recup l'id du bien à changer
if (isset($_GET['id'])) {
    $updates = getBody();
    //var_dump($updates);

    $id = $_GET['id'];
    $bdd = getDatabaseConnection();

    // Récupérer les informations de l'utilisateur à modifier
    $q = 'SELECT * FROM bien WHERE id = :id';
    $getbien = $bdd->prepare($q);
    $getbien->execute(['id' => $id]);
    $bien = $getbien->fetch(PDO::FETCH_ASSOC);

    if (!$bien) {
        die("Le bien avec l'ID $id n'existe pas.");
    }
} else {
    die('ID du bien non spécifié.');
}
//remplir les champs avec les anciennes valeurs

$nom_bien = $bien["nom_bien"];
$description = $bien["description"];
$couchage = $bien["couchage"];
$type_bien = $bien["type_bien"];
$type_location = $bien["type_location"];
$ville = $bien["ville"];
$adresse = $bien["adresse"];
$code_postal = $bien["code_postal"];
$prix_adulte = $bien["prix_adulte"];
$prix_enfant = $bien["prix_enfant"];
$prix_animaux = $bien["prix_animaux"];
$nb_lit = $bien["nb_lit"];
$piscine = $bien["piscine"];
$salle_eau = $bien["salle_eau"];
$images = $bien["images"];
$nb_chambres = $bien["nb_chambres"];
$dispo = $bien["dispo"];
$valide = $bien["valide"];


//récup les champs de l'utilisateur à changer,
// modifier les champs à update
if (isset($updates['nom_bien']) && !empty($updates['nom_bien'])) {
    $nom_bien = trim(htmlspecialchars($updates['nom_bien']));
}

if (isset($updates['description']) && !empty($updates['description'])) {
    $description = trim(htmlspecialchars($updates['description']));
}

if (isset($updates['couchage']) && !empty($updates['couchage'])) {
    $couchage = trim(htmlspecialchars($updates['couchage']));
}

if (isset($updates['type_bien']) && !empty($updates['type_bien'])) {
    $type_bien = trim(htmlspecialchars($updates['type_bien']));
}

if (isset($updates['type_location']) && !empty($updates['type_location'])) {
    $type_location = trim(htmlspecialchars($updates['type_location']));
}

if (isset($updates['ville']) && !empty($updates['ville'])) {
    $ville = trim(htmlspecialchars($updates['ville']));
}

if (isset($updates['adresse']) && !empty($updates['adresse'])) {
    $adresse = trim(htmlspecialchars($updates['adresse']));
}

if (isset($updates['code_postal']) && !empty($updates['code_postal'])) {
    $code_postal = trim(htmlspecialchars($updates['code_postal']));
}

if (isset($updates['prix_adulte']) && !empty($updates['prix_adulte'])) {
    $prix_adulte = trim(htmlspecialchars($updates['prix_adulte']));
}

if (isset($updates['prix_enfant']) && !empty($updates['prix_enfant'])) {
    $prix_enfant = trim(htmlspecialchars($updates['prix_enfant']));
}

if (isset($updates['prix_animaux']) && !empty($updates['prix_animaux'])) {
    $prix_animaux = trim(htmlspecialchars($updates['prix_animaux']));
}

if (isset($updates['nb_lit']) && !empty($updates['nb_lit'])) {
    $nb_lit = trim(htmlspecialchars($updates['nb_lit']));
}

if (isset($updates['piscine']) && !empty($updates['piscine'])) {
    $piscine = trim(htmlspecialchars($updates['piscine']));
}


if (isset($updates['salle_eau']) && !empty($updates['salle_eau'])) {
    $salle_eau = trim(htmlspecialchars($updates['salle_eau']));
}

if (isset($updates['images']) && !empty($updates['images'])) {
    $images = $updates['images']; // Assumant que c'est un tableau ou un chemin d'accès, le traitement pourrait varier
}

if (isset($updates['nb_chambres']) && !empty($updates['nb_chambres'])) {
    $nb_chambres = trim(htmlspecialchars($updates['nb_chambres']));
}

if (isset($updates['dispo']) && !empty($updates['dispo'])) {
    $dispo = trim(htmlspecialchars($updates['dispo']));
}

if (isset($updates['valide']) && !empty($updates['valide'])) {
    $valide = trim(htmlspecialchars($updates['valide']));
}

// envoyer l'objet $bien mis à jour à l'entité de gestion de bien pour la mise à jour en base de données.
updateBien($id, $nom_bien, $description, $couchage, $type_bien, $type_location, $ville, $adresse, $code_postal, $prix_adulte, $prix_enfant, $prix_animaux, $nb_lit, $piscine, $salle_eau, $images, $nb_chambres, $dispo, $valide);


