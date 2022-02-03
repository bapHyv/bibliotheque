<?php

    include './bdd.php';

    if (isset($_POST['btn_add_contact'])) {
        $nom = htmlentities($_POST['nom']);
        $mail = htmlentities($_POST['mail']);
        $objet = htmlentities($_POST['objet']);
        $message = htmlentities($_POST['message']);

        $sql = 'INSERT INTO contact VALUES (NULL, :nom, :mail, :objet, :message, NOW())';

        $requete = $bdd->prepare($sql);

        $data = array(
            ':nom' => $nom,
            ':mail' => $mail,
            ':objet' => $objet,
            ':message' => $message
        );

        if (!$requete->execute($data)) {
            //Afficher un message d'erreur
            header('location:add.php');
            die;
        } else {
            header('location:index.php');
            die;
        }
    }

    if (isset($_POST['btn_update_contact'])){
        // *** PROTECTION DES DONNEES ENVOYEES PAR L'UTILISATEUR ***
        $id = intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $mail = htmlentities($_POST['mail']);
        $objet = htmlentities($_POST['objet']);
        $message = htmlentities($_POST['message']);

        // *** TRAITEMENT DE DONNEES ***
            // ....

        // UPDATE EN BDD

        // 1) REQUETE SQL POUR LA MODIF
        $sql = 'UPDATE contact SET nom = :nom, mail = :mail, objet = :objet, message = :mess WHERE id = :id LIMIT 1';
        // 2) EXECUTE LA REQUETE
        
        $requete = $bdd->prepare($sql);

        $data = array (
            ':nom' => $nom,
            ':mail' => $mail,
            ':objet' => $objet,
            ':mess' => $message,
            ':id' => $id
        );
        
        // 3) VERIF SI UPDATE OK
        if (!$requete->execute($data)){
            // erreur dans la modif
            header('location:update.php?id='. $id);
            die;
        }else{
            // pas d'erreur 
            header('location:index.php');
            die;
        }
    }

    if (isset($_GET['id'])){
        $id = intval($_GET['id']);
        if ($id > 0){
            // DELETE
            // REQUETE SQL POUR DELETE UNE PRISE DE CONTACT
            $sql = 'DELETE FROM contact WHERE id = :id LIMIT 1';
            // var_dump($sql);
            // EXECUTE LA REQUETE
            $requete = $bdd->prepare($sql);

            $data = array(
                ':id' => $id
            );

            // VERIF SI REQUETE BIEN EXECUTE
            if (!$requete->execute($data)){
                // erreur
                header('location:index.php');
                die;
            }else{
                header('location:index.php');
                die;
            }
        }
    }

?>