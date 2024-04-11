
<?php
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../database/connection.php";
echo "delete";
//recup l'id de l'utilateur à supprimer
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $bdd = getDatabaseConnection();

    // Récupérer les informations de l'utilisateur à modifier
    $q = 'SELECT * FROM user WHERE id = :id';
    $getuser = $bdd->prepare($q);
    $getuser->execute(['id' => $id]);
    $user = $getuser->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("L'utilisateur avec l'ID $id n'existe pas.");
    }
} else {
    die('ID de l\'utilisateur non spécifié.');
}
//verifier que l'utilisateur est admin avant du supprimer
try {
    $query = 'DELETE FROM user WHERE id = :id';
    $stmt = $bdd->prepare($query);
    $success = $stmt->execute(['id' => $id]);
}catch (PDOException $e){
    echo jsonResponse(400, [], [
        'success' => true,
        'message' => "Un problème est survenu lors de la suppression de l'utilisateur " . $e->getMessage()
    ]);
}

if ($success) {
    echo jsonResponse(200, [], [
        'success' => true,
        'message' => "Utilisateur supprimé avec succès !"
    ]);
}

// requête sql delete pour supprimer l'utilisateur