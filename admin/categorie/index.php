<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    $sql = "SELECT * FROM categorie";

    $requete = $bdd->query($sql);

    $categories = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

        <?php 
            $styleSheet = '';
            $title = 'Liste des catégories';
            include URL_INCLUDE . 'includes/sidebar.php'; 
        ?>

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
                        <h1 class="text-center">Liste des categories</h1>

                        <?php if (isset($_SESSION['error_categorie']) && $_SESSION['error_categorie'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_categorie']);
                            unset($_SESSION['message_error']);
                        } if (isset($_SESSION['error_categorie']) && $_SESSION['error_categorie'] == true) {
                            alert($_SESSION['message_error'], "danger");
                            unset($_SESSION['error_categorie']);
                            unset($_SESSION['message_error']);
                        } ?>

                        <a href="<?= URL_ADMIN ?>categorie/ajouter.php" class="btn btn-success mb-3">Ajouter un categorie</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Libellé</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($categories as $categorie): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $categorie['id'] ?></th>
                                        <th scope="row"><?= $categorie['libelle'] ?></th>
                                        <td><a href="<?= URL_ADMIN ?>/categorie/modifier.php?id=<?=$categorie['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= URL_ADMIN ?>/categorie/action.php?id=<?=$categorie['id']?>" class="btn btn-danger">Supprimer</a></td>
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