<?php

function login(string $email, string $password)
{
	require_once __DIR__ . "/../database/connection.php";

	$databaseConnection = getDatabaseConnection();
	$getuserQuery = $databaseConnection->prepare("SELECT id, password FROM users WHERE email = :email");

$success = $getuserQuery->execute([
		"email" => $email
]);

		if (!$success) {
					return false;
		}

    
        $user = $getuserQuery->fetch(PDO::FETCH_ASSOC);
            
        
        if ($user) {

                $bddPassword = $user['password'];
                $userId = $user["id"];

		if ($bddPassword !== hash('sha1',$password)) {
					return false;
		}

	$addToken = $databaseConnection->prepare("UPDATE users SET token = :token WHERE id = :id");
    $token = bin2hex(random_bytes(16));
    $tokensuccess = $addToken->execute([
		"token" => $token,
        "id" => $userId
]);


return $token; 
}

}