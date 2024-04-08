
<?php
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../database/connection.php";
echo "delete";
//recup l'id du bien à supprimer
//avec l'interface web, on récupèrera l'id avec une autre methode plus sécurisée
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $bdd = getDatabaseConnection();

    $q = 'SELECT nom_bien FROM bien WHERE id = :id';
    $getbien = $bdd->prepare($q);
    $getbien->execute(['id' => $id]);
    $user = $getbien->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Le bien avec l'ID $id n'existe pas.");
    }
} else {
    die('ID du bien non spécifié.');
}
//TO DO : verifier que le bien n'a pas de locations futures avant du supprimer
//si oui renvoyer l'utilisateur vers une interface pour justifier la suppression
//prévenir tous les futurs voyageurs de l'annulation de leur réservation (processus de remboursement ?)
try {
    $query = 'DELETE FROM bien WHERE id = :id';
    $stmt = $bdd->prepare($query);
    $success = $stmt->execute(['id' => $id]);
}catch (PDOException $e){
    echo jsonResponse(400, [], [
        'success' => true,
        'message' => "Un problème est survenu lors de la suppression du bien: " . $e->getMessage()
    ]);
}

if ($success) {
    echo jsonResponse(200, [], [
        'success' => true,
        'message' => "Bien supprimé avec succès !"
    ]);
}

// requête sql delete pour supprimer l'utilisateur