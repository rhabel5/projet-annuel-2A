<?php

require_once __DIR__ . "/../entities/gettasks.php";
require_once __DIR__ . "/../entities/isconnected.php";

	if(!isConnected()) {
		echo jsonResponse(401, [], [
			"success" => false,
			"error" => " Provide an Authorization: Bearer token"
	]);
	die();
    }

    $taches = getTasks();

    if (is_string($taches)) {

        echo jsonResponse(500, ['Content-Type' => 'application/json'], [
            'success' => false,
            'error' => $taches
        ]);
    } else {
      
        if (!$taches) {
        
            echo jsonResponse(400, ['Content-Type' => 'application/json'], [
                'success' => false,
                'error' => 'No tasks found'
            ]);
        } else {
    
            echo jsonResponse(200, ['Content-Type' => 'application/json'], $taches);
        }
    }
    