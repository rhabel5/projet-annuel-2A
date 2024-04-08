<?php

require_once __DIR__ . "/../../database/connection.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/updateuser.php";
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/checkmail.php";

//recup l'id de l'utilisateur à changer
if (isset($_GET['id'])) {
    $updates = getBody();
    //var_dump($updates);

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
//remplir les champs avec les anciennes valeurs

$id = $user['id'];
$nom = $user['nom'];
$prenom = $user['prenom'];
$email = $user['email'];
$phone = $user['phone'];
$naissance = $user['naissance'];
$role = $user['role'];


//récup les champs de l'utilisateur à changer,
// modifier les champs à update
if (isset($updates['nom']) && !empty($updates['nom'])){;
    $nom = trim(htmlspecialchars($updates['nom']));
}

if (isset($updates['prenom']) && !empty($updates['prenom'])){;
    $prenom = trim(htmlspecialchars($updates['prenom']));
}

if (isset($updates['email']) && !empty($updates['email'])){;
    $email = trim(htmlspecialchars($updates['email']));
}

if (isset($updates['naissance']) && !empty($updates['naissance'])){;
    $naissance = trim(htmlspecialchars($updates['naissance']));
}

if (isset($updates['phone']) && !empty($updates['phone'])){;
    $phone = trim(htmlspecialchars($updates['phone']));
}

if (isset($updates['role']) && !empty($updates['role'])){;
    //avant de changer la valeur du rôle, on vérifiera si l'utilisateur est un admin ou non
    $role = trim(htmlspecialchars($updates['role']));
}


//envoyer à l'entité update user pour l'ajout en base de données
updateUser($id, $nom, $prenom, $email, $naissance, $phone, $role);

