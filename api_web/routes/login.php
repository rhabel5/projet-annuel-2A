<?php

require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/../libraries/body.php";
require_once __DIR__ . "/../entities/register.php";
require_once __DIR__ . "/../entities/login.php";
require_once __DIR__ . "/../libraries/response.php";
require_once __DIR__ . "/../entities/checkmail.php";

$body = getBody();
$email = $body["email"];
$password = $body["password"];

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

if(!checkmail($email)){
    echo jsonResponse(400, ['Content-Type' => 'application/json'], [
		'success' => false,
		'error' => 'Email introuvable'
]);
	die();
}

$token = login($email, $password);

if (!$token) {
	echo jsonResponse(400, [], [
		'success' => false,
		'error' => 'Email or password invalid'
]);

	die();
}else{
    echo jsonResponse(200, [], [
		'success' => false,
		'error' => 'Connection réussie',
        'token' => $token
]);

}

