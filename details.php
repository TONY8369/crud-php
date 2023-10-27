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
} else {
    // message d'erreur avec session
    $_SESSION['erreur'] = "URL invalide";
    //redirigé vers index.php //
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Detail du produit</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <h1>Detail du produit <?= $produit['produit']  ?></h1>
            <section class="col-12">
                <p>ID : <?= $produit['id']  ?> </p>
                <p>Nom : <?= $produit['produit']  ?> </p>
                <p>Nombre<?= $produit['number'] > 1 ? "s" : "" ?> : <?= $produit['number']  ?> </p>
                <p>Prix : <?= $produit['price']  ?> fr </p>
                <p> <a href="index.php" class="btn btn-primary">Retour</a> <a href="edit.php?=<?= $produit['id']  ?>" class="btn btn-primary">Modifier</a></p>
            </section>
        </div>
    </main>
</body>

</html>