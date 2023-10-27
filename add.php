<?php
//on demarre la session
session_start();
// on verifie que des infos ont bien était envoyé par notre formulaire
if (isset($_POST)) {
    // arréter le code
    // die('ca marche');
    if 
    (isset($_POST['produit']) && !empty($_POST['produit']) && isset($_POST['price']) && !empty($_POST['price'])
        && isset($_POST['number']) && !empty($_POST['number'])){
           // on inclut la connection à la base de donnée
        require_once 'connect.php';
            // on nettoie les données envoyé
        $produit = strip_tags($_POST['produit']);
        $number = strip_tags($_POST['number']);
        $price = strip_tags($_POST['price']);
        // requete sql pour ajouté 
        $sql = 'INSERT INTO `liste` (`produit`, `price`, `number`)
        VALUES (:produit, :price, :number );';
        // on prepare la requete
        $query = $db->prepare($sql);
        //On accroche les paramètre produit, price, number
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':price', $price, PDO::PARAM_STR);
        $query->bindValue(':number', $number, PDO::PARAM_INT);
        // on execute la requete 
        $query->execute();

        // message d'ajout d'un produit avec session
        $_SESSION['message'] = "Produit ajouté";
        require_once 'close.php'; 
        //redirigé vers index.php //
        header('Location: index.php');
   
    }else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Ajouter un produits</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <h1>Ajouter un produit</h1>
            <section class="col-12">
                <?php if (!empty($_SESSION['erreur'])) : ?>
                    <?= '<div class="alert alert-danger"> ' . $_SESSION['erreur'] . ' </div>';
                    $_SESSION['erreur'] = ""; ?>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="produit">Produit</label>
                        <input type="text" id="produit" name="produit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number">Nombre</label>
                        <input type="number" id="number" name="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="text" id="price" name="price" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>