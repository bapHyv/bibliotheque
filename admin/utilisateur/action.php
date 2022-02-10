<?php

    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_POST['ajouter_utilisateur'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        $mdp = htmlentities($_POST['mdp']);
        $numero = htmlentities($_POST['numero']);
        $avatar = htmlentities($_FILES['avatar']['name']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);

        $target = URL_INCLUDE . 'img/utilisateur/' . $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], $target);

        $sql = 'INSERT INTO utilisateur VALUES (NULL, :nom, :prenom, :pseudo, :mail, :mdp, :numero, :avatar, :adresse, :ville, :code_postal)';

        $requete = $bdd->prepare($sql);

        $data = array(
        ':nom' => $nom, 
        ':prenom' => $prenom,
        ':pseudo' => $pseudo, 
        ':mail' => $mail, 
        ':mdp' => $mdp, 
        ':numero' => $numero,
        ':avatar' => $avatar, 
        ':adresse' => $adresse, 
        ':ville' => $ville, 
        ':code_postal' => $code_postal 
        );

        if ($requete->execute($data)) {
            $_SESSION['error_utilisateur'] = false;
            $_SESSION['message_error'] = 'Vous avez bien ajouté l\'utilisateur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . '/utilisateur/index.php');
            die;
        } else {
            $_SESSION['error_utilisateur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'utilisateur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . '/utilisateur/ajouter.php');
            die;
        }
    }

    if (isset($_POST['modifier_utilisateur'])) {
        $id = intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        $mdp = htmlentities($_POST['mdp']);
        $numero = htmlentities($_POST['numero']);
        $avatar = htmlentities($_FILES['avatar']['name']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);

        if ($avatar == '') {
            $avatar = htmlentities($_POST['avatar_hidden']);
        } else {
            $target = URL_INCLUDE . 'img/utilisateur/' . $_FILES['avatar']['name'];
            move_uploaded_file($_FILES['avatar']['tmp_name'], $target);
        }

        $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, mot_de_passe = :mdp, num_telephone = :numero, avatar = :avatar, adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id = :id LIMIT 1';
    
        $requete = $bdd->prepare($sql);

        $data = array(
            ':id' => $id,
            ':nom' => $nom, 
            ':prenom' => $prenom,
            ':pseudo' => $pseudo, 
            ':mail' => $mail, 
            ':mdp' => $mdp, 
            ':numero' => $numero,
            ':avatar' => $avatar, 
            ':adresse' => $adresse, 
            ':ville' => $ville, 
            ':code_postal' => $code_postal 
        );

        if ($requete->execute($data)) {
            $_SESSION['error_utilisateur'] = false;
            $_SESSION['message_error'] = 'Vous avez bien modifié l\'utilisateur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . 'utilisateur/index.php');
            die;
        } else {
            $_SESSION['error_utilisateur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de la modification de l\'utilisateur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . 'utilisateur/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            // RECUPÈRE LE NOM ET LE PRENOM DE L'UTILISATEUR POUR LE MESSAGE D'ERREUR OU DE SUCCES
            $sqlUtilisateur = 'SELECT nom, prenom FROM utilisateur WHERE id = :id LIMIT 1';
            $requeteUtilisateur = $bdd->prepare($sqlUtilisateur);
            $requeteUtilisateur->execute([':id' => $id]);
            $dataUtilisateur = $requeteUtilisateur->fetchAll(PDO::FETCH_ASSOC);

            $sql = 'DELETE FROM utilisateur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                $_SESSION['error_utilisateur'] = false;
                $_SESSION['message_error'] = 'Vous avez bien supprimé l\'utilisateur: "<b>' . $dataUtilisateur[0]['prenom'] . ' ' . $dataUtilisateur[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . 'utilisateur/index.php');
                die;
            } else {
                $_SESSION['error_utilisateur'] = true;
                $_SESSION['message_error'] = 'Erreur lors de la suppression de l\'utilisateur: "<b>' . $dataUtilisateur[0]['prenom'] . ' ' . $dataUtilisateur[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . 'utilisateur/index.php');
                die;
            }
        }
    }

?>