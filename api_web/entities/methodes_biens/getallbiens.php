<?php
function getAllBiens()
{
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();
    $getAllBiensQuery = $databaseConnection->prepare("SELECT * FROM bien");

    try {
        $success = $getAllBiensQuery->execute();

        if ($success) {
            $AllBiensData = $getAllBiensQuery->fetchAll(PDO::FETCH_ASSOC);
            return $AllBiensData;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Retourne le message de l'exception
        return $e->getMessage();
    }
}
