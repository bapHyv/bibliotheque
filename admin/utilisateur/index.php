<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    $sql = "SELECT * FROM utilisateur";

    $requete = $bdd->query($sql);

    $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
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
                        <h1 class="text-center">Liste des utilisateurs</h1>

                        <?php if (isset($_SESSION['error_utilisateur']) && $_SESSION['error_utilisateur'] == false) {
                            alert($_SESSION['message_error'], "success");
                            unset($_SESSION['error_utilisateur']);
                            unset($_SESSION['message_error']);
                        } if (isset($_SESSION['error_utilisateur']) && $_SESSION['error_utilisateur'] == true) {
                            alert($_SESSION['message_error'], "danger");
                            unset($_SESSION['error_utilisateur']);
                            unset($_SESSION['message_error']);
                        } ?>

                        <a href="<?= URL_ADMIN ?>utilisateur/ajouter.php" class="btn btn-success mb-3">Ajouter un utilisateur</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Mot de passe</th>
                                    <th scope="col">Numéros de téléphone</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code postal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- BOUCLE SUR LE TABLEAU D'OCCURENCE -->
                                <?php foreach ($utilisateurs as $utilisateur): ?>
                                    <tr>
                                        <!-- AFFICHAGE DES CHAMPS -->
                                        <th scope="row"><?= $utilisateur['id'] ?></th>
                                        <th scope="row"><?= $utilisateur['nom'] ?></th>
                                        <th scope="row"><?= $utilisateur['prenom'] ?></th>
                                        <th scope="row"><?= $utilisateur['pseudo'] ?></th>
                                        <th scope="row"><?= $utilisateur['mail'] ?></th>
                                        <th scope="row"><?= $utilisateur['mot_de_passe'] ?></th>
                                        <th scope="row"><?= $utilisateur['num_telephone'] ?></th>
                                        <th scope="row"><img style="width: 50%;" src="<?= URL_ADMIN . 'img/utilisateur/' . $utilisateur['avatar'] ?>" alt="<?= $utilisateur['prenom'] . ' ' . $utilisateur['nom'] ?>"></th>
                                        <th scope="row"><?= $utilisateur['adresse'] ?></th>
                                        <th scope="row"><?= $utilisateur['ville'] ?></th>
                                        <th scope="row"><?= $utilisateur['code_postal'] ?></th>
                                        <td><a href="<?= URL_ADMIN ?>/utilisateur/modifier.php?id=<?=$utilisateur['id']?>" class="btn btn-warning">Modifier</a></td>
                                        <td><a href="<?= URL_ADMIN ?>/utilisateur/action.php?id=<?=$utilisateur['id']?>" class="btn btn-danger">Supprimer</a></td>
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