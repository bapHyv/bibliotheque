<?php

    include './bdd.php';
    include '../config/config.php';

    if (isset($_POST['ajouter_livre'])) {
        $num_ISBN = htmlentities($_POST['num_ISBN']);
        $titre = htmlentities($_POST['titre']);
        $illustration = htmlentities($_POST['illustration']);
        $resumee = htmlentities($_POST['resumee']);
        $prix = htmlentities($_POST['prix']);
        $nb_pages = htmlentities($_POST['nb_pages']);
        $disponibilite = boolval($_POST['disponibilite']);

        $sql = 'INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resumee, :prix, :nb_pages, NOW() , :disponibilite)';
        
        $requete = $bdd->prepare($sql);

        $data = array(
        ':num_ISBN' => $num_ISBN, 
        ':titre' => $titre,
        ':illustration' => $illustration, 
        ':resumee' => $resumee, 
        ':prix' => $prix,
        ':nb_pages' => $nb_pages, 
        ':disponibilite' => $disponibilite
        );

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'livre/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
            header('location:' . URL_ADMIN . 'livre/ajouter.php');
            die;
        }
    }

    if (isset($_POST['modifier_livre'])) {
        $id = intval($_POST['id']);
        $num_ISBN = htmlentities($_POST['num_ISBN']);
        $titre = htmlentities($_POST['titre']);
        $illustration = htmlentities($_POST['illustration']);
        $resume = htmlentities($_POST['resume']);
        $prix = htmlentities($_POST['prix']);
        $nb_pages = intval($_POST['nb_pages']);
        $disponibilite = boolval($_POST['disponibilite']);
        
        $sql = 'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, illustration = :illustration, resume = :resume, prix = :prix, nb_pages = :nb_pages, disponibilite = :disponibilite WHERE id = :id LIMIT 1';

        $requete = $bdd->prepare($sql);

        $data = array (
            ':id' => $id,
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':illustration' => $illustration,
            ':resume' => $resume,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':disponibilite' => $disponibilite
        );

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'livre/index.php');
            die;
        } else {
            header('location:' . URL_ADMIN . 'livre/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM livre WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                header('location:' . URL_ADMIN . 'livre/index.php');
                die;
            } else {
                echo "<p>Erreur base de données</p>";
                header('location:' . URL_ADMIN . 'livre/index.php');
                die;
            }
        }
    }

?>