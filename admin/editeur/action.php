<?php

    include '../config/bdd.php';
    include '../config/config.php';
    include '../config/functions.php';

    if (isset($_POST['ajouter_editeur'])) {
        $denomination = htmlentities($_POST['denomination']);
        $siret = htmlentities($_POST['siret']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);

        $sql = 'INSERT INTO editeur VALUE (NULL, :denomination, :siret, :adresse, :ville, :code_postal, :mail, :numero)';

        $requete = $bdd->prepare($sql);

        $data = array(
        ':denomination' => $denomination, 
        ':siret' => $siret,
        ':adresse' => $adresse, 
        ':ville' => $ville, 
        ':code_postal' => $code_postal,
        ':mail' => $mail, 
        ':numero' => $numero
        );

        if (!$requete->execute($data)) {
            $_SESSION['error_editeur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'editeur: "<b>' . $denomination . '</b>"';
            header('location:' . URL_ADMIN . 'editeur/ajouter.php');
            die;
        }

        $success_message = 'Vous avez bien ajouté l\'éditeur: "<b>' . $denomination . '</b>"';

        executeSqlUtilisateurAction('id_editeur', $bdd, action_ajouter($bdd, 1), 'editeur/', 'error_editeur', $success_message);
    }

    if (isset($_POST['modifier_editeur'])) {
        $id = intval($_POST['id']);
        $denomination = htmlentities($_POST['denomination']);
        $siret = htmlentities($_POST['siret']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        
        $sql = 'UPDATE editeur SET denomination = :denomination, siret = :siret, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero_tel = :numero WHERE id = :id LIMIT 1';

        // $sql = 'UPDATE editeur SET denomination = :denomination, siret = :siret, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero_tel = :numero WHERE id = :id LIMIT 1';

        $requete = $bdd->prepare($sql);

        $data = array (
            ':id' => $id,
            ':denomination' => $denomination,
            ':siret' => $siret,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':mail' => $mail,
            ':numero' => $numero
        );

        if (!$requete->execute($data)) {
            $_SESSION['error_editeur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de la modification de l\'editeur: "<b>' . $denomination . '</b>"';
            header('location:' . URL_ADMIN . 'editeur/modifier.php?id=' . $id);
            die;
        } 
        
        $success_message = 'Vous avez bien modifier l\'éditeur: "<b>' . $denomination . '</b>"';
        
        executeSqlUtilisateurAction('id_editeur', $bdd, action_modifier_supprimer(2, $id), 'editeur/', 'error_editeur', $success_message);

    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            // RECUPÈRE LA DÉNOMINATION DE L'ÉDITEUR POUR LES MESSAGES D'ERREURS ET DE SUCCES
            $sqlEditeur = 'SELECT denomination FROM editeur WHERE id = :id LIMIT 1';
            $requeteEditeur = $bdd->prepare($sqlEditeur);
            $requeteEditeur->execute([':id' => $id]);
            $editeurDenomination = $requeteEditeur->fetch(PDO::FETCH_ASSOC);

            $sql = 'DELETE FROM editeur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                $_SESSION['error_editeur'] = false;
                $_SESSION['message_error'] = 'L\'éditeur "<b>' . $editeurDenomination['denomination'] . '"</b> a bien été supprimé';
                header('location:' . URL_ADMIN . 'editeur/index.php');
                die;
            } else {
                $_SESSION['error_editeur'] = true;
                $_SESSION['message_error'] = 'Erreur lors de la suppression de l\'éditeur: "<b>' . $editeurDenomination['denomination'] . '<b>"';
                header('location:' . URL_ADMIN . 'editeur/index.php');
                die;
            }
        }
    }

?>