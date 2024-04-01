<?php

function register(string $email, string $password, string $nom, string $prenom, string $phone, string $role, string $naissance)
{
    require_once __DIR__ . "/../database/connection.php";

    try {
        $bdd = getDatabaseConnection();
        $getUser = $bdd->prepare("INSERT INTO user (email, password) VALUES(:email, :password, :nom, :prenom, :phone, :role, :naissance)");

        $success = $getUser->execute([
            "email" => $email,
            "password" => hash('sha1',$password),
            "nom" => $nom,
            "prenom" => $prenom,
            "phone" => $phone,
            "role" => $role
        ]);

        if ($success) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
    }
}
