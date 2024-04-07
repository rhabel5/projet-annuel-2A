<?php

function addBailleurs(string $email, string $password, string $nom, string $prenom, string $role, string $naissance, string $phone)
{
    require_once __DIR__ . "/../database/connection.php";

    try {
        $databaseConnection = getDatabaseConnection();
        $getUser = $databaseConnection->prepare("INSERT INTO user (email, password, nom, prenom, phone, role, naissance) VALUES(:email, :password, :nom, :prenom, :phone, :role, :naissance)");

        $success = $getUser->execute([
            "email" => htmlspecialchars($email)
        ]);

        if ($success) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
    }
}
