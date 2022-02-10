<?php
    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_POST['ajouter_auteur'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_FILES['photo']['name']);

        //VERIFIER QUE LES CHAMPS SONT BIEN REMPLIS !!!!!

        $target = URL_INCLUDE . 'img/auteur/' . $_FILES['photo']['name'];

        move_uploaded_file($_FILES['photo']['tmp_name'], $target);

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
            $_SESSION['error_auteur'] = false;
            $_SESSION['message_error'] = 'Vous avez bien ajouté l\'auteur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . '/auteur/index.php');
            die;
        } else {
            $_SESSION['error_auteur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'auteur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . '/auteur/ajouter.php');
            die;
        }
    }

    if (isset($_POST['modifier_auteur'])) {
        $id = intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_FILES['photo']['name']);
        
        if ($photo == '') {
            $photo = htmlentities($_POST['photo_hidden']);
        } else {
            $target = URL_INCLUDE . 'img/auteur/' . $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        }

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
            $_SESSION['error_auteur'] = false;
            $_SESSION['message_error'] = 'Vous avez bien modifié l\'auteur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die;
        } else {
            $_SESSION['error_auteur'] = true;
            $_SESSION['message_error'] = 'Erreur lors de la modification de l\'auteur: "<b>' . $prenom . ' ' . $nom . '</b>"';
            header('location:' . URL_ADMIN . 'auteur/modifier.php?id=' . $id);
            die;
        }
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            // RECUPÈRE LE NOM ET LE PRENOM DE L'AUTEUR POUR LE MESSAGE D'ERREUR OU DE SUCCES
            $sqlAuteur = 'SELECT nom, prenom FROM auteur WHERE id = :id LIMIT 1';
            $requeteAuteur = $bdd->prepare($sqlAuteur);
            $requeteAuteur->execute([':id' => $id]);
            $dataAuteur = $requeteAuteur->fetchAll(PDO::FETCH_ASSOC);

            $sql = 'DELETE FROM auteur WHERE id = :id LIMIT 1';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);
            if ($requete->execute($data)) {
                $_SESSION['error_auteur'] = false;
                $_SESSION['message_error'] = 'Vous avez bien supprimé l\'auteur: "<b>' . $dataAuteur[0]['prenom'] . ' ' . $dataAuteur[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . '/auteur/index.php');
                die;
            } else {
                $_SESSION['error_auteur'] = true;
                $_SESSION['message_error'] = 'Erreur lors de la suppression de l\'auteur: "<b>' . $dataAuteur[0]['prenom'] . ' ' . $dataAuteur[0]['nom'] . '</b>"';
                header('location:' . URL_ADMIN . '/auteur/index.php');
                die;
            }
        }
    }
?>