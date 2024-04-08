<?php

function registerProperty($id_bailleur, $nom_bien, $description, $couchage, $type_bien, $type_location, $ville, $adresse, $code_postal, $prix_adulte, $prix_enfant, $prix_animaux, $nb_lit, $piscine, $note_moyenne, $salle_eau, $images, $nb_chambres, $dispo, $valide) {
    require_once __DIR__ . "/../../database/connection.php";

    try {
        $databaseConnection = getDatabaseConnection();
        $query = "INSERT INTO bien (id_bailleur, nom_bien, description, couchage, type_bien, type_location, ville, adresse, code_postal, prix_adulte, prix_enfant, prix_animaux, nb_lit, piscine, note_moyenne, salle_eau, images, nb_chambres, dispo, valide) VALUES (:id_bailleur, :nom_bien, :description, :couchage, :type_bien, :type_location, :ville, :adresse, :code_postal, :prix_adulte, :prix_enfant, :prix_animaux, :nb_lit, :piscine, :note_moyenne, :salle_eau, :images, :nb_chambres, :dispo, :valide)";

        $statement = $databaseConnection->prepare($query);

        $success = $statement->execute([
            ':id_bailleur' => $id_bailleur,
            ':nom_bien' => $nom_bien,
            ':description' => $description,
            ':couchage' => $couchage,
            ':type_bien' => $type_bien,
            ':type_location' => $type_location,
            ':ville' => $ville,
            ':adresse' => $adresse,
            ':code_postal' => $code_postal,
            ':prix_adulte' => $prix_adulte,
            ':prix_enfant' => $prix_enfant,
            ':prix_animaux' => $prix_animaux,
            ':nb_lit' => $nb_lit,
            ':piscine' => $piscine,
            ':note_moyenne' => $note_moyenne,
            ':salle_eau' => $salle_eau,
            ':images' => $images,
            ':nb_chambres' => $nb_chambres,
            ':dispo' => $dispo,
            ':valide' => $valide,
        ]);

        if ($success) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du bien dans la base de données : " . $e->getMessage();
        return false;
    }
}
