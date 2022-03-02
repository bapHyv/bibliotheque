<?php 

    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'SELECT * FROM livre WHERE id = :id';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);
            $requete->execute($data);
            $livre = $requete->fetch(PDO::FETCH_ASSOC);
        } else {
            header('location:' . URL_ADMIN . 'livre/index.php');
            die;
        }
    }

?>
        <?php
            $styleSheet = '<link rel="stylesheet" href="' . URL_ADMIN . 'css/single-livre.css">';
            $title = $livre['titre'];
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
                        <a href="<?= URL_ADMIN?>livre/index.php" class="btn btn-info">Retour</a>
                        <h1 class="text-center mb-5"><?= $livre['titre']?></h1>
                        <div class="img-resume">
                            <img src="<?= URL_ADMIN?>/img/livre/<?= $livre['illustration']?>" alt="">
                            <div class="ml-5 mr-5">
                                <p class="resume"><b>Résumé: </b><?= $livre['resume']?></p>
                                <p><b>Prix:</b> <?= $livre['prix']?></p>
                                <p><b>Nombre de pages:</b> <?= $livre['nb_pages']?></p>
                                <p><b>Date d'achat:</b> <?= $livre['date_achat']?></p>
                                <p><b>Disponibilité: </b> <?php if ($livre['disponibilite']) {echo 'Disponible';} else {echo 'Loué';} ?></p>
                            </div>
                        </div>
                            
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php include URL_INCLUDE . 'includes/footer.php'; ?>