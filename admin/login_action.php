<?php

    include './config/bdd.php';

    if (isset($_POST['login'])) {
        $mail = htmlentities($_POST['mail']);
        $password = htmlentities($_POST['mot_de_passe']);

        $sql = 'SELECT pseudo, mail, mot_de_passe, avatar FROM utilisateur WHERE mail = :mail LIMIT 1';
        $requete = $bdd->prepare($sql);
        $data = [':mail' => $mail];
        $requete->execute($data);
        $data_user = $requete->fetch(PDO::FETCH_ASSOC);
        $user_pseudo = $data_user['pseudo'];
        $user_mail = $data_user['mail'];
        $user_hash = $data_user['mot_de_passe'];
        $user_avatar = $data_user['avatar'];

        echo '<br>';
        if (password_verify($password, $user_hash)) {
            session_start();
            $_SESSION['logged_user'] = $user_mail;
            $_SESSION['logged_pseudo'] = $user_pseudo;
            $_SESSION['logged_avatar'] = $user_avatar;
            header('location:index.php');
            die;
        }
    }




?>