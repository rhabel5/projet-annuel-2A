<?php

require_once __DIR__ . "/connection.php";

try {
    $databaseConnection = getDatabaseConnection();

    $databaseConnection->query("DROP TABLE IF EXISTS bailleurs;");
    $databaseConnection->query("DROP TABLE IF EXISTS bien;");
    $databaseConnection->query("DROP TABLE IF EXISTS commentaires;");
    $databaseConnection->query("DROP TABLE IF EXISTS facture;");
    $databaseConnection->query("DROP TABLE IF EXISTS images;");
    $databaseConnection->query("DROP TABLE IF EXISTS prestataires;");
    $databaseConnection->query("DROP TABLE IF EXISTS reservation;");
    $databaseConnection->query("DROP TABLE IF EXISTS user;");
    $databaseConnection->query("DROP TABLE IF EXISTS voyageur;");

    $databaseConnection->query("
        CREATE TABLE bailleurs (
            id INT(11) NOT NULL AUTO_INCREMENT,
            biens INT(11) NOT NULL,
            id_prestations INT(11) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE bien (
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_bailleur INT(11) NOT NULL,
            nom_bien VARCHAR(60) NOT NULL,
            description VARCHAR(60) NOT NULL,
            couchage INT(11) NOT NULL,
            type_bien VARCHAR(60) NOT NULL,
            type_location VARCHAR(60) NOT NULL,
            ville VARCHAR(60) NOT NULL,
            adresse VARCHAR(60) NOT NULL,
            code_postale INT(11) NOT NULL,
            prix_adulte INT(11) NOT NULL,
            prix_enfant INT(11) NOT NULL,
            prix_animaux INT(11) NOT NULL,
            nb_lit INT(11) NOT NULL,
            piscine TINYINT(1) NOT NULL,
            note_moyenne INT(11) NOT NULL,
            salle_eau INT(11) NOT NULL,
            images INT(11) NOT NULL,
            nb_chambres INT(11) NOT NULL,
            dispo INT(11) NOT NULL,
            valide TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE commentaires (
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_bien INT(11) NOT NULL,
            id_voyageur INT(11) NOT NULL,
            note INT(11) NOT NULL,
            contenu VARCHAR(120) NOT NULL,
            date_publication DATE NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE facture (
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_bien INT(11) NOT NULL,
            id_client INT(11) NOT NULL,
            id_bailleur INT(11) NOT NULL,
            id_presations INT(11) NOT NULL,
            prix_location INT(11) NOT NULL,
            prix_prestations INT(11) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE images (
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_bien INT(11) NOT NULL,
            chemin VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE prestataires (
            id_user INT(11) NOT NULL AUTO_INCREMENT,
            note_moyenne INT(11) NOT NULL,
            id_prestations INT(11) NOT NULL,
            PRIMARY KEY (id_user)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE reservation (
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_bien INT(11) NOT NULL,
            id_client INT(11) NOT NULL,
            id_bailleur INT(11) NOT NULL,
            date_debut DATE NOT NULL,
            date_fin DATE NOT NULL,
            nb_animaux INT(11) NOT NULL,
            nb_adulte INT(11) NOT NULL,
            nb_enfant INT(11) NOT NULL,
            statut VARCHAR(60) NOT NULL,
            prix_total INT(11) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE user (
            id INT(11) NOT NULL AUTO_INCREMENT,
            nom VARCHAR(60) NOT NULL,
            prenom VARCHAR(60) NOT NULL,
            email VARCHAR(60) NOT NULL UNIQUE,
            naissance DATE NOT NULL,
            password VARCHAR(60) NOT NULL,
            phone VARCHAR(60) NOT NULL,
            role VARCHAR(60) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $databaseConnection->query("
        CREATE TABLE voyageur (
            id INT(11) NOT NULL AUTO_INCREMENT,
            reservations_passe VARCHAR(255) NOT NULL,
            reservation_futur INT(11) NOT NULL,
            reservation_en_cours INT(11) NOT NULL,
            vip TINYINT(1) NOT NULL,
            commentaires INT(11) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    echo "Migration réussie" . PHP_EOL;
} catch (Exception $exception) {
    echo "Une erreur est survenue durant la migration des données" . PHP_EOL;
    echo $exception->getMessage();
}