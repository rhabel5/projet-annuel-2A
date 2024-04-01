<?php

require_once __DIR__ . "/connection.php";

try {
    $databaseConnection = getDatabaseConnection();
    $databaseConnection->query("SELECT 1 + 1;");

    echo "Migration réussie" . PHP_EOL;
} catch (Exception $exception) {
    echo "Une erreur est survenue durant la migration des données" . PHP_EOL;
    echo $exception->getMessage();
}
