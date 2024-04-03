<?php

require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/../libraries/body.php";
require_once __DIR__ . "/../entities/adduser.php";
require_once __DIR__ . "/../libraries/response.php";
require_once __DIR__ . "/../entities/checkmail.php";

$body = getBody();
$email = $body["email"];
$password = $body["password"];
$nom = $body["nom"];
$prenom = $body["prenom"];
$naissance = $body["naissance"];
$naissance = DateTime::createFromFormat('d/m/Y', $body["naissance"]);
$date_naissance = $naissance->format('Y-m-d');
$phone = $body["phone"];
echo "LALALLALALALLALALALALA";
var_dump($body);
echo "MIMIMIIMIMIIMIM";
$role = $body["role"];

if($email === ""){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => 'Email not found'
]);

	die();
}

if($password === ""){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => 'Password not found'
]);

	die();
}

if(empty($phone)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
        'success' => false,
        'error' => 'Phone not found'
    ]);

    die();
}

if(empty($prenom)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
        'success' => false,
        'error' => 'Name not found'
    ]);

    die();
}

if(empty($nom)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
        'success' => false,
        'error' => 'Nom not found'
    ]);

    die();
}

if(empty($naissance)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
        'success' => false,
        'error' => 'Password not found'
    ]);

    die();
}





if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => 'Email invalide'
]);
	die();		
}

if (strlen($password) < 8) {
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => 'Le mot de passe doit faire au moins 8 caractères'
]);
	die();	
}


if(checkmail($email)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => "Ce mail est déjà utilisé"
]);
	die();
}



$inscription = register($email, $password, $nom, $prenom, $role, $date_naissance, $phone);

if ($inscription) {
	echo jsonResponse(400, [], [
		'success' => true,
		'error' => "Ajout Réussi"
]);

	die();
}

echo jsonResponse(400, [], [
    'success' => false,
    'error' => 'Échec de l\'ajout'
]);

