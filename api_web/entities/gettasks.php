<?php
function getTasks()
{
    require_once __DIR__ . "/../database/connection.php";

    $databaseConnection = getDatabaseConnection();
    $getTasksQuery = $databaseConnection->prepare("SELECT description FROM tasks");

    try {
        $success = $getTasksQuery->execute();

        if ($success) {
            $tasksData = $getTasksQuery->fetchAll(PDO::FETCH_COLUMN);
            return $tasksData;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Retourne le message de l'exception
        return $e->getMessage();
    }
}
