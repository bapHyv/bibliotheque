<?php

    include './bdd.php';
    include '../config/config.php';

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

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . '/usager/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
            header('location:' . URL_ADMIN . '/usager/ajouter.php');
            die;
        }
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
            header('location:' . URL_ADMIN . 'usager/index.php');
            die;
        } else {
            header('location:' . URL_ADMIN . 'usager/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM usager WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                header('location:' . URL_ADMIN . 'usager/index.php');
                die;
            } else {
                echo "<p>Erreur base de données</p>";
                header('location:' . URL_ADMIN . 'usager/index.php');
                die;
            }
        }
    }

?>