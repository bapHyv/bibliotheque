<?php
    $dsn = 'mysql:dbname=bibliotheque_clone;host=localhost';
    $user = 'root';
    $password = '';

    try {
        $bdd = new PDO($dsn, $user, $password);
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
?>