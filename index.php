<?php
//on démarre la session 
session_start();
// on inclut la connection à la base de donnée
require_once 'connect.php';
//requete sql qui selectionne ma table
$sql = 'SELECT * FROM `liste`';
// on prepare la requete
$query = $db->prepare($sql);
// on execute la requete
$query->execute();
// on stocke le résultat dans un tableau //
$result = $query->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);

require_once 'close.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Liste des produits</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <h1>Liste des produits</h1>
            <section class="col-12">
                <?php if (!empty($_SESSION['erreur'])) : ?>
                    <?php '<div class="alert alert-danger"> ' . $_SESSION['erreur'] . ' </div>';
                    $_SESSION['erreur'] = "" ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION['message'])) : ?>
                    <?= '<div class="alert alert-success"> ' . $_SESSION['message'] . ' </div>';
                    $_SESSION['message'] = "" ?>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Nombre</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php // on boucle sur la variable résult pour affichez nos données
                        foreach ($result as $listes) : ?>
                            <tr>
                                <td> <?= $listes['id'] ?></td>
                                <td><?= $listes['produit'] ?></td>
                                <td><?= $listes['number'] ?></td>
                                <td><?= $listes['price'] ?> fr</td>
                                <td>
                                    <a href="details.php?id=<?= $listes['id'] ?>" class="btn btn-primary">Voir</a>
                                    <a href="edit.php?id=<?= $listes['id'] ?>" class="btn btn-primary">Edité</a>
                                    <a href="delete.php?id=<?= $listes['id'] ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>

</html>