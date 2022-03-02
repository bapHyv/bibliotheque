<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    $sql = "SELECT * FROM livre";

    $requete = $bdd->query($sql);

    $livres = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

        <?php 
            $styleSheet = '<link rel="stylesheet" href="' . URL_ADMIN . 'css/liste-livres.css">';
            $title = 'Liste des livres';
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
                    <div>
                        <h1 class="text-center">Liste des livres</h1>

                        <?php if (isset($_SESSION['error_livre']) && $_SESSION['error_livre'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_livre']);
                            unset($_SESSION['message_error']);
                        } if (isset($_SESSION['error_livre']) && $_SESSION['error_livre'] == true) {
                            alert($_SESSION['message_error'], "danger");
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
                                        <th><?= $livre['num_ISBN'] ?></th>
                                        <th><?= $livre['titre'] ?></th>
                                        <th><img style="width: 40%;" class="illustration" src="<?= URL_ADMIN ?>img/livre/<?= $livre['illustration'] ?>" alt="<?= $livre['titre'] ?>"></th>
                                        <?php $resume = mb_substr($livre['resume'], 0, 100, 'UTF-8');?>
                                        <th><?php echo $resume; ?>...</th>
                                        <th><?= $livre['prix'] ?></th>
                                        <th><?= $livre['nb_pages'] ?></th>
                                        <th><?= $livre['date_achat'] ?></th>
                                        <?php
                                            if ($livre['disponibilite']) {
                                                echo '<th class="green">disponible</th>';
                                            } else {
                                                echo '<th class="red">loué</th>';
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