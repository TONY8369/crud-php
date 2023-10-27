<?php
// connection à la base de donnée //
try {
    // connection à la base de donnée
    $db = new PDO('mysql:host=localhost;dbname=crud_php', 'root', 'root');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $execption) {
    // capturé et retranscrire l'erreur 
    echo 'Erreur' . $execption->getMessage();
    // arréter le processus
    die();
}
 ?>