<?php

    include './bdd.php';
    include '../config/config.php';

    if (isset($_POST['ajouter_categorie'])) {
        $libelle = htmlentities($_POST['libelle']);

        $sql = 'INSERT INTO categorie VALUES (NULL, :libelle)';

        $requete = $bdd->prepare($sql);

        $data = array(':libelle' => $libelle);

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . '/categorie/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
            header('location:' . URL_ADMIN . '/categorie/ajouter.php');
            die;
        }
    }

    if (isset($_POST['modifier_categorie'])) {
        $id = intval($_POST['id']);
        $libelle = htmlentities($_POST['libelle']);
    
        $sql = 'UPDATE categorie SET libelle = :libelle WHERE id = :id LIMIT 1';

        $requete = $bdd->prepare($sql);

        $data = array(
            ':id' => $id,
            ':libelle' => $libelle, 
        );

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'categorie/index.php');
            die;
        } else {
            header('location:' . URL_ADMIN . 'categorie/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM categorie WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                header('location:' . URL_ADMIN . 'categorie/index.php');
                die;
            } else {
                echo "<p>Erreur base de données</p>";
                header('location:' . URL_ADMIN . 'categorie/index.php');
                die;
            }
        }
    }

?>