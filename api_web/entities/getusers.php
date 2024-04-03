<?php
function getUsers()
{
    require_once __DIR__ . "/../database/connection.php";

    $databaseConnection = getDatabaseConnection();
    $getUsersQuery = $databaseConnection->prepare("SELECT * FROM user");

    try {
        $success = $getUsersQuery->execute();

        if ($success) {
            $usersData = $getUsersQuery->fetchAll(PDO::FETCH_ASSOC);
            return $usersData;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Retourne le message de l'exception
        return $e->getMessage();
    }
}
