<?php

$urlUpdate = "http://localhost:8888/projet_bibliotheque_clone/admin/auteur/modifier.php";
$urlDelete = "http://localhost:8888/projet_bibliotheque_clone/admin/auteur/action.php";

// 1- IMPORTER LE FICHIER QUI CONTIENT L'INSTANCE DU PDO
include './bdd.php';

// 2- CRÉER LA REQUÊTE SQL POUR LE READ ET LA CONSERVER DANS UNE VARIABLE
$sql = 'SELECT * FROM auteur';

// 3- PRÉPARE ET EXECUTE LA REQUÊTE SQL
$requete = $bdd->query($sql); //reçois un PDOStatement

// 4- ON STOCK LES DONNÉES DE LA BDD DANS UNE VARIABLE
$auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);

//reçois les données formatées selon le mode passé en argument de fetchALL()
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

        <?php include '../includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include '../includes/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard clone</h1>
                    </div>
                    <div>
                        <h1 class="text-center">Liste des auteurs</h1>
                        <a href="http://localhost:8888/projet_bibliotheque_clone/admin/auteur/ajouter.php" class="btn btn-success">Ajouter un auteur</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom de plume</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code postal</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Numero de téléphone</th>
                                    <th scope="col">Photo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($auteurs as $auteur): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $auteur['id'] ?></th>
                                        <td><?= $auteur['nom'] ?></td>
                                        <td><?= $auteur['prenom'] ?></td>
                                        <td><?= $auteur['nom_de_plume'] ?></td>
                                        <td><?= $auteur['adresse'] ?></td>
                                        <td><?= $auteur['ville'] ?></td>
                                        <td><?= $auteur['code_postal'] ?></td>
                                        <td><?= $auteur['mail'] ?></td>
                                        <td><?= $auteur['numero'] ?></td>
                                        <td><?= $auteur['photo'] ?></td>
                                        <td><a href="<?= $urlUpdate?>?id=<?= $auteur['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= $urlDelete?>?id=<?= $auteur['id'] ?>" class="btn btn-danger">Supprimer</a></td>
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

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>