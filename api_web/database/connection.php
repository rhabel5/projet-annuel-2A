<?php

function getDatabaseConnection(): PDO
{
    return $databaseConnection = new PDO("mysql:host=localhost;dbname=pcs_db", "usertest", "azerty");
}