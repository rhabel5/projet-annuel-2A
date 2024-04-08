<?php
function checkmail(string $email)
{
    require_once __DIR__ . "/../../database/connection.php";

    $bdd = getDatabaseConnection();
    $user = $bdd->prepare("SELECT id FROM user WHERE email = :email");

    $success = $user->execute([
        "email" => $email
    ]);

    if ($success) {
  
        $usermail = $user->fetch(PDO::FETCH_ASSOC);
    
        if ($usermail) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
