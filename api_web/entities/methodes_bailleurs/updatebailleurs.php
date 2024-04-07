<?php


function updateUser(string $id, string $nom, string $prenom, string $email, string $naissance, string $phone, string $role)
{
    require_once __DIR__ . "/../database/connection.php";

    try {
        $databaseConnection = getDatabaseConnection();
        $userinfo = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, naissance = :naissance, phone = :phone, role = :role WHERE id = :id";
        $updateuser = $databaseConnection->prepare($userinfo);
        $success = $updateuser->execute([
            "id" => $id,
            "email" => htmlspecialchars($email),
            "nom" => htmlspecialchars($nom),
            "prenom" => htmlspecialchars($prenom),
            "phone" => htmlspecialchars($phone),
            "role" => htmlspecialchars($role),
            "naissance" => htmlspecialchars($naissance)
        ]);

        if ($success) {
            echo "\nModification de l'utilisateur réussie !\n";
            return true;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de l'utilisateur en base de données : " . $e->getMessage();
    }
}
