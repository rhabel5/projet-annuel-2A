<?php

function postTask(string $description)
{
    require_once __DIR__ . "/../database/connection.php";

    try {
        $bdd = getDatabaseConnection();
        $addDesc = $bdd->prepare("INSERT INTO tasks (description) VALUES(:description)");

        $success = $addDesc->execute([
            "description" => $description
        ]);

        if ($success) {
            return true;
        }
    } catch (PDOException $e) {
        return "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
    }
}
