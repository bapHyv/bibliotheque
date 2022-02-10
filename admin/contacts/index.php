<?php
    // 1- IMPORTER LE FICHIER QUI CONTIENT L'INSTANCE DU PDO
    include '../config/config.php';
    include './bdd.php';

    // 2- CRÉER LA REQUÊTE SQL POUR LE READ ET LA CONSERVER DANS UNE VARIABLE
    $sql = 'SELECT * FROM contact';
    
    // 3- PRÉPARE ET EXECUTE LA REQUÊTE SQL
    $requete = $bdd->query($sql); //reçois un PDOStatement
    
    // 4- ON STOCK LES DONNÉES DE LA BDD DANS UNE VARIABLE
    $contacts = $requete->fetchAll(PDO::FETCH_ASSOC); //reçois les données formatées selon le mode passé en argument de fetchALL()
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
    <link href="<?= URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">

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
                    <div class="container">
        <h1 class="text-center">Liste des contacts</h1>
        <a href="<?= URL_ADMIN?>contacts/add.php" class="btn btn-success mb-3">Ajouter un contact</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Message</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <!-- AFFICHAGE DES CHAMPS -->
                        <th scope="row"><?= $contact['id'] ?></th>
                        <td><?= $contact['nom'] ?></td>
                        <td><?= $contact['mail'] ?></td>
                        <td><?= $contact['objet'] ?></td>
                        <td><?= $contact['message'] ?></td>
                        <td><a href="<?= URL_ADMIN?>contacts/update.php?id=<?= $contact[
                            'id'
                        ] ?>" class="btn btn-warning">Modifier</a></td>
                        <td><a href="<?= URL_ADMIN?>contacts/action.php?id=<?= $contact[
                            'id'
                        ] ?>" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php include '../includes/footer.php'; ?>