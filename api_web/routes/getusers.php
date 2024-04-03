<?php



function getUsers()
{
    require_once __DIR__ . "../database/connection.php";

    $databaseConnection = getDatabaseConnection();
    $getUsersQuery = $databaseConnection->prepare("SELECT * FROM users");

    try {
        $success = $getUsersQuery->execute();

        if ($success) {
            $usersData = $getUsersQuery->fetchAll(PDO::FETCH_COLUMN);
            return $usersData;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Retourne le message de l'exception
        return $e->getMessage();
    }
}