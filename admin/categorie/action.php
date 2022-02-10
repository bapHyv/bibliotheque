<?php

    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_POST['ajouter_categorie'])) {
        $libelle = htmlentities($_POST['libelle']);

        $sql = 'INSERT INTO categorie VALUES (NULL, :libelle)';

        $requete = $bdd->prepare($sql);

        $data = array(':libelle' => $libelle);

        if ($requete->execute($data)) {
            $_SESSION['error_categorie'] = false;
            $_SESSION['message_error'] = 'Vous avez bien ajouter la catégorie: "<b>' . $libelle . '</b>"';
            header('location:' . URL_ADMIN . '/categorie/index.php');
            die;
        } else {
            $_SESSION['error_categorie'] = true;
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de la categorie: "<b>' . $libelle . '</b>"';
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
            $_SESSION['error_categorie'] = false;
            $_SESSION['message_error'] = 'Vous avez bien modifier la catégorie: "<b>' . $libelle . '</b>"';
            header('location:' . URL_ADMIN . 'categorie/index.php');
            die;
        } else {
            $_SESSION['error_categorie'] = true;
            $_SESSION['message_error'] = 'Erreur lors de la modification de la categorie: "<b>' . $libelle . '</b>"';
            header('location:' . URL_ADMIN . 'categorie/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            // RECUPÈRE LE LIBELLE DE LA CATÉGORIE POUR LES MESSAGE D'ERREURS ET DE SUCCES
            $sqlCategorie = 'SELECT libelle FROM categorie WHERE id = :id LIMIT 1';
            $requeteCategorie = $bdd->prepare($sqlCategorie);
            $requeteCategorie->execute([':id' => $id]);
            $libelleCategorie = $requeteCategorie->fetch(PDO::FETCH_ASSOC);

            $sql = 'DELETE FROM categorie WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                $_SESSION['error_categorie'] = false;
                $_SESSION['message_error'] = 'La catégorie "<b>' . $libelleCategorie['libelle'] . '"</b> a bien été supprimé';
                header('location:' . URL_ADMIN . 'categorie/index.php');
                die;
            } else {
                $_SESSION['error_categorie'] = true;
                $_SESSION['message_error'] = 'Erreur lors de la suppression de la catégorie: "<b>' . $libelleCategorie['libelle'] . '<b>"';
                header('location:' . URL_ADMIN . 'categorie/index.php');
                die;
            }
        }
    }

?>