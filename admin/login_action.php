<?php

    include './config/bdd.php';

    if (isset($_POST['login'])) {
        $mail = htmlentities($_POST['mail']);
        $password = htmlentities($_POST['mot_de_passe']);

        $sql = 'SELECT mail, mot_de_passe FROM utilisateur WHERE mail = :mail LIMIT 1';
        $requete = $bdd->prepare($sql);
        $data = [':mail' => $mail];
        $requete->execute($data);
        $data_user = $requete->fetch(PDO::FETCH_ASSOC);
        $user_mail = $data_user['mail'];
        $user_hash = $data_user['mot_de_passe'];

        echo '<br>';
        if (password_verify($password, $user_hash)) {
            session_start();
            $_SESSION['logged_user'] = $user_mail;
            header('location:index.php');
            die;
        }
    }




?>