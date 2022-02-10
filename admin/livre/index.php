<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    $sql = "SELECT * FROM livre";

    $requete = $bdd->query($sql);

    $livres = $requete->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="<?= URL_ADMIN?>css/liste-livres.css">
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
                        <h1 class="text-center">Liste des livres</h1>

                        <?php if (isset($_SESSION['error_livre']) && $_SESSION['error_livre'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_livre']);
                            unset($_SESSION['message_error']);
                        } else {
                            alert($_SESSION['message_error'], "error");
                            unset($_SESSION['error_livre']);
                            unset($_SESSION['message_error']);
                        } ?>

                        <a href="<?= URL_ADMIN ?>livre/ajouter.php" class="btn btn-success mb-3">Ajouter un livre</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Numéro ISBN</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Illustration</th>
                                    <th scope="col">Résumé</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Nb de pages</th>
                                    <th scope="col">Date d'achat</th>
                                    <th scope="col">Disponibilité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($livres as $livre): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $livre['id'] ?></th>
                                        <th scope="row"><?= $livre['num_ISBN'] ?></th>
                                        <th scope="row"><?= $livre['titre'] ?></th>
                                        <th scope="row"><img style="width: 40%;" class="illustration" src="<?= URL_ADMIN ?>img/livre/<?= $livre['illustration'] ?>" alt="<?= $livre['titre'] ?>"></th>
                                        <?php $resume = mb_substr($livre['resume'], 0, 100, 'UTF-8');?>
                                        <th scope="row"><?php echo $resume; ?>...</th>
                                        <th scope="row"><?= $livre['prix'] ?></th>
                                        <th scope="row"><?= $livre['nb_pages'] ?></th>
                                        <th scope="row"><?= $livre['date_achat'] ?></th>
                                        <?php
                                            if ($livre['disponibilite']) {
                                                echo '<th class="green" scope="row">disponible</th>';
                                            } else {
                                                echo '<th class="red" scope="row">loué</th>';
                                            }
                                        
                                        ?>
                                        <td><a href="<?= URL_ADMIN ?>livre/single.php?id=<?=$livre['id']?>" class="btn btn-info">Infos</a></td>
                                        <td><a href="<?= URL_ADMIN ?>livre/modifier.php?id=<?=$livre['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= URL_ADMIN ?>livre/action.php?id=<?=$livre['id']?>" class="btn btn-danger">Supprimer</a></td>
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