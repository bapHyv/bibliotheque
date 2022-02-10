<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';


    $sql = "SELECT * FROM usager";

    $requete = $bdd->query($sql);

    $usagers = $requete->fetchAll(PDO::FETCH_ASSOC);

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
                        <h1 class="text-center">Liste des usagers</h1>

                        <?php if (isset($_SESSION['error_usager']) && $_SESSION['error_usager'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_usager']);
                            unset($_SESSION['message_error']);
                        }
                        if (isset($_SESSION['error_usager']) && $_SESSION['error_usager'] == true) {
                            alert($_SESSION['message_error'], "danger");
                            unset($_SESSION['error_usager']);
                            unset($_SESSION['message_error']);
                        } ?>

                        <a href="<?= URL_ADMIN ?>usager/ajouter.php" class="btn btn-success mb-3">Ajouter un usager</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code postal</th>
                                    <th scope="col">Mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($usagers as $usager): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $usager['id'] ?></th>
                                        <th scope="row"><?= $usager['nom'] ?></th>
                                        <th scope="row"><?= $usager['prenom'] ?></th>
                                        <th scope="row"><?= $usager['adresse'] ?></th>
                                        <th scope="row"><?= $usager['ville'] ?></th>
                                        <th scope="row"><?= $usager['code_postal'] ?></th>
                                        <th scope="row"><?= $usager['mail'] ?></th>
                                        <td><a href="<?= URL_ADMIN ?>/usager/modifier.php?id=<?=$usager['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= URL_ADMIN ?>/usager/action.php?id=<?=$usager['id']?>" class="btn btn-danger">Supprimer</a></td>
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