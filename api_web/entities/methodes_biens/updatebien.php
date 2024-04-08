<?php


function updateBien(
    string $id,
    string $nom_bien,
    string $description,
    string $couchage,
    string $type_bien,
    string $type_location,
    string $ville,
    string $adresse,
    string $code_postal,
    string $prix_adulte,
    string $prix_enfant,
    string $prix_animaux,
    string $nb_lit,
    string $piscine,
    string $salle_eau,
    string $images,
    string $nb_chambres,
    string $dispo,
    string $valide
) {
    require_once __DIR__ . "/../../database/connection.php";

    try {
        $databaseConnection = getDatabaseConnection();
        $bienInfo = "UPDATE bien SET 
            nom_bien = :nom_bien, 
            description = :description, 
            couchage = :couchage, 
            type_bien = :type_bien, 
            type_location = :type_location, 
            ville = :ville, 
            adresse = :adresse, 
            code_postal = :code_postal, 
            prix_adulte = :prix_adulte, 
            prix_enfant = :prix_enfant, 
            prix_animaux = :prix_animaux, 
            nb_lit = :nb_lit, 
            piscine = :piscine,  
            salle_eau = :salle_eau, 
            images = :images, 
            nb_chambres = :nb_chambres, 
            dispo = :dispo, 
            valide = :valide 
        WHERE id = :id";

        $updateBien = $databaseConnection->prepare($bienInfo);
        $success = $updateBien->execute([
            "id" => $id,
            "nom_bien" => htmlspecialchars($nom_bien),
            "description" => htmlspecialchars($description),
            "couchage" => htmlspecialchars($couchage),
            "type_bien" => htmlspecialchars($type_bien),
            "type_location" => htmlspecialchars($type_location),
            "ville" => htmlspecialchars($ville),
            "adresse" => htmlspecialchars($adresse),
            "code_postal" => htmlspecialchars($code_postal),
            "prix_adulte" => htmlspecialchars($prix_adulte),
            "prix_enfant" => htmlspecialchars($prix_enfant),
            "prix_animaux" => htmlspecialchars($prix_animaux),
            "nb_lit" => htmlspecialchars($nb_lit),
            "piscine" => htmlspecialchars($piscine),
            "salle_eau" => htmlspecialchars($salle_eau),
            "images" => $images,
            "nb_chambres" => htmlspecialchars($nb_chambres),
            "dispo" => htmlspecialchars($dispo),
            "valide" => htmlspecialchars($valide)
        ]);


        if ($success) {
            echo "\nModification de l'utilisateur réussie !\n";
            return true;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de l'utilisateur en base de données : " . $e->getMessage();
    }
}
