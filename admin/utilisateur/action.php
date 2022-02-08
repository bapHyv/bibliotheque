<?php

    include './bdd.php';
    include '../config/config.php';

    if (isset($_POST['ajouter_utilisateur'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        $mdp = htmlentities($_POST['mdp']);
        $numero = htmlentities($_POST['numero']);
        $avatar = htmlentities($_POST['avatar']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);

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
            header('location:' . URL_ADMIN . '/utilisateur/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
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
        $avatar = htmlentities($_POST['avatar']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);

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
            header('location:' . URL_ADMIN . 'utilisateur/index.php');
            die;
        } else {
            header('location:' . URL_ADMIN . 'utilisateur/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM utilisateur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                header('location:' . URL_ADMIN . 'utilisateur/index.php');
                die;
            } else {
                echo "<p>Erreur base de données</p>";
                header('location:' . URL_ADMIN . 'utilisateur/index.php');
                die;
            }
        }
    }

?>