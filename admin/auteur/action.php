<?php
    include './bdd.php';
    include '../config/config.php';

    if (isset($_POST['ajouter_auteur'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_POST['photo']);

        //VERIFIER QUE LES CHAMPS SONT BIEN REMPLIS !!!!!

        $sql = 'INSERT INTO auteur VALUES (NULL, :nom, :prenom, :nom_de_plume, :adresse, :ville, :code_postal, :mail, :numero, :photo)';

        $requete = $bdd->prepare($sql);

        $data = array(
            ':nom' => $nom, 
            ':prenom' => $prenom, 
            ':nom_de_plume' => $nom_de_plume, 
            ':adresse' => $adresse, 
            ':ville' => $ville, 
            ':code_postal' => $code_postal, 
            ':mail' => $mail, 
            ':numero' => $numero, 
            ':photo' => $photo 
        );

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . '/auteur/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
            header('location:' . URL_ADMIN . '/auteur/ajouter.php');
            die;
        }
    }

    if (isset($_POST['modifier_auteur'])) {
        echo '<p>dans modifier auteur</p>';
        $id = intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_POST['photo']);

        $sql = 'UPDATE auteur SET nom = :nom, prenom = :prenom, nom_de_plume = :nom_de_plume, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero = :numero, photo = :photo WHERE id = :id LIMIT 1';

        $requete = $bdd->prepare($sql);

        $data = array(
            ':id' => $id,
            ':nom' => $nom, 
            ':prenom' => $prenom, 
            ':nom_de_plume' => $nom_de_plume, 
            ':adresse' => $adresse, 
            ':ville' => $ville, 
            ':code_postal' => $code_postal, 
            ':mail' => $mail, 
            ':numero' => $numero, 
            ':photo' => $photo 
        );

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die;
        } else {
            echo '<p>PB BDD</p>';
            header('location:' . URL_ADMIN . 'auteur/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM auteur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);
            if ($requete->execute($data)) {
                header('location:' . URL_ADMIN . '/auteur/index.php');
                die;
            } else {
                header('location:' . URL_ADMIN . '/auteur/index.php');
                die;
            }
        }
    }

    echo '<p>Fin action</p>'
?>