<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    $sql = "SELECT * FROM editeur";

    $requete = $bdd->query($sql);

    $editeurs = $requete->fetchAll(PDO::FETCH_ASSOC);

    var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bibliotheque admin</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include URL_INCLUDE . 'includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include URL_INCLUDE . 'includes/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard clone</h1>
                    </div>
                    <div>
                        <h1 class="text-center">Liste des editeurs</h1>

                        <?php if (isset($_SESSION['error_editeur']) && $_SESSION['error_editeur'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_editeur']);
                            unset($_SESSION['message_error']);
                        } 
                        if (isset($_SESSION['error_editeur']) && $_SESSION['error_editeur'] == true) {
                            alert($_SESSION['message_error'], "danger");
                            unset($_SESSION['error_editeur']);
                            unset($_SESSION['message_error']);
                        } ?>

                        <a href="<?= URL_ADMIN ?>editeur/ajouter.php" class="btn btn-success mb-3">Ajouter un editeur</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Dénomination</th>
                                    <th scope="col">SIRET</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code postal</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Numéros de téléphone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($editeurs as $editeur): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $editeur['id'] ?></th>
                                        <th scope="row"><?= $editeur['denomination'] ?></th>
                                        <th scope="row"><?= $editeur['siret'] ?></th>
                                        <th scope="row"><?= $editeur['adresse'] ?></th>
                                        <th scope="row"><?= $editeur['ville'] ?></th>
                                        <th scope="row"><?= $editeur['code_postal'] ?></th>
                                        <th scope="row"><?= $editeur['mail'] ?></th>
                                        <th scope="row"><?= $editeur['numero_tel'] ?></th>
                                        <td><a href="<?= URL_ADMIN ?>editeur/modifier.php?id=<?=$editeur['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= URL_ADMIN ?>editeur/action.php?id=<?=$editeur['id']?>" class="btn btn-danger">Supprimer</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php include URL_INCLUDE . 'includes/footer.php'; ?>