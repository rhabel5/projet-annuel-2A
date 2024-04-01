<?php

require_once __DIR__ . "/../libraries/body.php";
require_once __DIR__ . "/../entities/gettasks.php";
require_once __DIR__ . "/../entities/postdescription.php";

require_once __DIR__ . "/../entities/isconnected.php"
	if(!isConnected()) {
		echo jsonResponse(401, [], [
			"success" => false,
			"error" => " Provide an Authorization: Bearer token"
	]);
	die();
    }

    $body = getBody();
    $description = $body["description"];
    
    if($description === ""){
        echo jsonResponse(400, ['Content-Type' => 'application/json'], [
            'success' => false,
            'error' => 'Description not found'
    ]);
    
        die();
    }

    if(!is_string($description)){
        echo jsonResponse(400, ['Content-Type' => 'application/json'], [
            'success' => false,
            'error' => 'Description is not a string'
    ]);
    
        die();
    }
$postTask = postTask($description)
    if(is_string($postTask)){
        echo jsonResponse(200, ['Content-Type' => 'application/json'], [
            'success' => true,
            'error' => $postTask
    ]);
    
    die();
}
    echo jsonResponse(200, ['Content-Type' => 'application/json'], [
        'success' => true,
        'message: Created'
]);
