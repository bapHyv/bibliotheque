<?php
    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_POST['btn_repondre_contact'])){
        // *** PROTECTION DES DONNEES ENVOYEES PAR L'UTILISATEUR ***
        $id = intval($_POST['id']);
        $message_reponse = htmlentities($_POST['message_reponse']);

        // *** TRAITEMENT DE DONNEES ***
            // ....

        // UPDATE EN BDD

        // 1) REQUETE SQL POUR LA MODIF
        $sql = '';
        // 2) EXECUTE LA REQUETE
        
        $requete = $bdd->prepare($sql);

        $data = array ();
        
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
