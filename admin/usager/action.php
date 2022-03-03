<?php

    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_POST['ajouter_usager'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);

        $sql = 'INSERT INTO usager VALUES (NULL, :nom, :prenom, :adresse, :ville, :code_postal, :mail)';

        $requete = $bdd->prepare($sql);

        $data = array(
        ':nom' => $nom, 
        ':prenom' => $prenom,
        ':adresse' => $adresse, 
        ':ville' => $ville, 
        ':code_postal' => $code_postal,
        ':mail' => $mail
        );

        if (!$requete->execute($data)) {
            $_SESSION['error_usager'] = true;
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'usager: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . '/usager/ajouter.php');
            die;
        }

        $success_message = 'Vous avez bien ajouté l\'usager: "<b>' . $prenom . ' ' . $nom . '</b>"';

        executeSqlUtilisateurAction('id_usager', $bdd, action_ajouter($bdd, 1), 'usager/', 'error_usager', $success_message);
    }

    if (isset($_POST['modifier_usager'])) {
        $id = intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);

        $sql = 'UPDATE usager SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail WHERE id = :id LIMIT 1';
        
        $requete = $bdd->prepare($sql);

        $data = array(
            ':id' => $id,
            ':nom' => $nom, 
            ':prenom' => $prenom,
            ':adresse' => $adresse, 
            ':ville' => $ville, 
            ':code_postal' => $code_postal, 
            ':mail' => $mail
        );

        if ($requete->execute($data)) {
            $_SESSION['error_usager'] = true;
            $_SESSION['message_error'] = 'Erreur lors de la modification de l\'usager: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . 'usager/modifier.php?id=' . $id);
            die;
        }

        $success_message = 'Vous avez bien modifié l\'usager: "<b>' . $prenom . ' ' . $nom . '</b>"';
        
        executeSqlUtilisateurAction('id_usager', $bdd, action_modifier_supprimer(2, $id), 'usager/', 'error_usager', $success_message);
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            // RECUPÈRE LE NOM ET LE PRENOM DE L'USAGER POUR LE MESSAGE D'ERREUR OU DE SUCCES
            $sqlUsager = 'SELECT nom, prenom FROM usager WHERE id = :id LIMIT 1';
            $requeteUsager = $bdd->prepare($sqlUsager);
            $requeteUsager->execute([':id' => $id]);
            $dataUsager = $requeteUsager->fetchAll(PDO::FETCH_ASSOC);

            $sql = 'DELETE FROM usager WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                $_SESSION['error_usager'] = false;
                $_SESSION['message_error'] = 'Vous avez bien supprimé l\'Usager: "<b>' . $dataUsager[0]['prenom'] . ' ' . $dataUsager[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . 'usager/index.php');
                die;
            } else {
                $_SESSION['error_usager'] = true;
                $_SESSION['message_error'] = 'Erreur lors de la suppression de l\'Usager: "<b>' . $dataUsager[0]['prenom'] . ' ' . $dataUsager[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . 'usager/index.php');
                die;
            }
        }
    }

?>