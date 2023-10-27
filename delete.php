<?php
// on démarre la session
session_start();
// on verifie qu'il y est bien un id dans l 'url et qu'il n'est pas vide dans url
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');
    // on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `liste` WHERE `id` = :id';
    //on prepare la requete //
    $query = $db->prepare($sql);
    //On accroche les paramètre id
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    // on execute la requete 
    $query->execute();
    //On recupère le produit
    $produit = $query->fetch();
    //On verifie si le produit existe 
    if (!$produit) {
        // message d'erreur avec session
        $_SESSION['erreur'] = "Cette id n'existe pas";
        //redirigé vers index.php //
        header('Location: index.php');
    }
    // requete sql pour supprimer
    $sql = 'DELETE FROM `liste` WHERE `id` = :id';
    //on prepare la requete //
    $query = $db->prepare($sql);
    //On accroche les paramètre id
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    // on execute la requete 
    $query->execute();
    // message de success avec session
    $_SESSION['message'] = "Produit supprimé";
    //redirigé vers index.php //
    header('Location: index.php');
} else {
    // message d'erreur avec session
    $_SESSION['erreur'] = "URL invalide";
    //redirigé vers index.php //
    header('Location: index.php');
}
