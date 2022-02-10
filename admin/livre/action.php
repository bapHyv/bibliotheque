<?php
include '../config/config.php';
include '../config/bdd.php';

if (isset($_POST['ajouter_livre'])) {

    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $illustration = htmlentities($_FILES['illustration']['name']);
    $resume = htmlentities($_POST['resume']);
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $disponibilite = boolval($_POST['disponibilite']);

    $target = URL_INCLUDE . 'img/livre/' . $_FILES['illustration']['name'];

    move_uploaded_file($_FILES['illustration']['tmp_name'], $target);

    $sql = 'INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resume, :prix, :nb_pages, NOW(), :disponibilite)';

    $requete = $bdd->prepare($sql);

    $data = array(
    ':num_ISBN' => $num_ISBN,
    ':titre' => $titre,
    ':illustration' => $illustration,
    ':resume' => $resume,
    ':prix' => $prix,
    ':nb_pages' => $nb_pages,
    ':disponibilite' => $disponibilite
    );

    if ($requete->execute($data)) {
       $_SESSION['error_livre'] = false;
       $_SESSION['message_error'] = 'Vous avez bien ajouter: "<b>' . $titre . '</b>"';
       header('location:' . URL_ADMIN . 'livre/index.php');
       die();
    } else {
       $_SESSION['error_livre'] = true;
       $_SESSION['message_error'] =
           'Erreur lors de l\'ajout du livre: "<b>' . $titre . '</b>"';
       header('location:' . URL_ADMIN . 'livre/ajouter.php');
       die();
    }
 }

if (isset($_POST['modifier_livre'])) {
    $id = intval($_POST['id']);
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $illustration = htmlentities($_FILES['illustration']['name']);
    $resume = htmlentities($_POST['resume']);
    $prix = htmlentities($_POST['prix']);
    $nb_pages = intval($_POST['nb_pages']);
    $disponibilite = boolval($_POST['disponibilite']);

    if ($illustration == '') {
        $illustration = htmlentities($_POST['illustration_hidden']);
    } else {
        $target = URL_INCLUDE . 'img/livre/' . $_FILES['illustration']['name'];
        move_uploaded_file($_FILES['illustration']['tmp_name'], $target);
    }

    $sql =
        'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, illustration = :illustration, resume = :resume, prix = :prix, nb_pages = :nb_pages, disponibilite = :disponibilite WHERE id = :id LIMIT 1';

    $requete = $bdd->prepare($sql);

    $data = [
        ':id' => $id,
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':disponibilite' => $disponibilite,
    ];

    if ($requete->execute($data)) {
        $_SESSION['error_livre'] = false;
        $_SESSION['message_error'] = 'Vous avez bien modifier: "<b>' . $titre . '</b>"';
        header('location:' . URL_ADMIN . 'livre/index.php');
        die();
    } else {
        $_SESSION['error_livre'] = true;
        $_SESSION['message_error'] =
            'Erreur lors de la modification du livre: "<b>' . $titre . '</b>"';
        header('location:' . URL_ADMIN . 'livre/modifier.php?id=' . $id);
        die();
    }
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        // RECUPÈRE LE TITRE DU LIVRE POUR LE MESSAGE
        $sqlNomLivre = 'SELECT titre FROM livre WHERE id = :id LIMIT 1';
        $requeteNomLivre = $bdd->prepare($sqlNomLivre);
        $requeteNomLivre->execute([':id' => $id]);
        $titreLivre = $requeteNomLivre->fetch(PDO::FETCH_ASSOC);

        $sql = 'DELETE FROM livre WHERE id = :id LIMIT 1';
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];

        if ($requete->execute($data)) {
            $_SESSION['error_livre'] = false;
            $_SESSION['message_error'] =
                'Le livre "<b>' . $titreLivre['titre'] . '"</b> a bien été supprimé';
            header('location:' . URL_ADMIN . 'livre/index.php');
            die();
        } else {
            $_SESSION['error_livre'] = true;
            $_SESSION['message_error'] =
                'Erreur lors de la suppression du livre: "<b>' . $titreLivre['titre'] . '<b>"';
            header('location:' . URL_ADMIN . 'livre/index.php');
            die();
        }
    }
}

?>
