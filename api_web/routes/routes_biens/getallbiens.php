<?php

require_once __DIR__ . "./../../entities/methodes_biens/getallbiens.php";
//TO DO :cette méthode est destinée aux admins
//faire plusieurs méthodes pour chercher des biens selon différents critères
$biens = getAllBiens();

// Convertir les données au format JSON
$json_data = json_encode($biens);

// Envoyer les en-têtes HTTP pour spécifier que la réponse est au format JSON
header('Content-Type: application/json');

// Afficher les données JSON
echo $json_data;
