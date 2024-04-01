<?php
require_once __DIR__ . "/../database/connection.php";

function isconnected(){
	$headers = getallheaders();

$authHeader = $headers["Authorization"];


$authParts = explode("", $authHeader); 
	
if(!isser($authParts[0])){
	return false;
}

if(!isser($authParts[1])){
	return false;
}	

$auhtType = $authParts[0];
$token = $authParts[1];

if(!$authType==="bearer"){
	return false;
}

$databaseConnection = getDatabaseConnection();
$getuserQuery = $databaseConnection->prepare("SELECT id FROM users WHERE token = :token");

$success = $getuserQuery->execute([
    "token" => $token
]);


if(!$succes){
 return false;
}



}