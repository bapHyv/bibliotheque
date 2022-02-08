<?php 

$dsn = 'mysql:dbname=bibliotheque_clone;host=localhost';
$user = 'root';
$pw = '';

try {
    $bdd = new PDO($dsn, $user, $pw);
} catch (PDOException $err) {
    echo $err->getMessage();
}

?>