<?php

require_once __DIR__ . "/../entities/getusers.php";

$users = getUsers();

// Convertir les données au format JSON
$json_data = json_encode($users);

// Envoyer les en-têtes HTTP pour spécifier que la réponse est au format JSON
header('Content-Type: application/json');

// Afficher les données JSON
echo $json_data;
