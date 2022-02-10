<?php

    include './bdd.php';
    include '../config/config.php';

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

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'editeur/index.php');
            die;
        } else {
            echo '<p>PROBLEME AVEC LA BDD</p>';
            header('location:' . URL_ADMIN . 'editeur/ajouter.php');
            die;
        }
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

        if ($requete->execute($data)) {
            header('location:' . URL_ADMIN . 'editeur/index.php');
            die;
        } else {
            header('location:' . URL_ADMIN . 'editeur/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'DELETE FROM editeur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);

            if($requete->execute($data)) {
                header('location:' . URL_ADMIN . 'editeur/index.php');
                die;
            } else {
                echo "<p>Erreur base de données</p>";
                header('location:' . URL_ADMIN . 'editeur/index.php');
                die;
            }
        }
    }

?>