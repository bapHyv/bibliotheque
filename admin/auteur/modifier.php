<?php

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = 'SELECT * FROM auteur WHERE id = :id';
            $requete = $bdd->prepare($sql);
            $data = array(':id' => $id);
            $requete->execute($data);
            $auteur = $requete->fetch(PDO::FETCH_ASSOC);
        } else {
          header('location:header.php');
          die;
        }
    }
?>

<?php
    $styleSheet = '';
    $title = 'Modifier ' . $auteur['prenom'] . ' ' . $auteur['nom'];
    include URL_INCLUDE . 'includes/sidebar.php';
  ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <?php
      include URL_INCLUDE . 'includes/topbar.php';
    ?>

    <div class="container">
    <h1 class="text-center mt-5">Modifier <?= $auteur['prenom'] . ' ' . $auteur['nom'] ?></h1>
      <?php

        if (isset($_SESSION['error_auteur']) && $_SESSION['error_auteur'] == true) {
          alert($_SESSION['message_error'], 'danger');
          unset($_SESSION['error_auteur']);
          unset($_SESSION['message_error']);
      }?>
      
    <form action="<?= URL_ADMIN?>auteur/action.php" method="POST" enctype='multipart/form-data'>
        <input type="hidden" name="id" value="<?= $auteur['id']?>">

        <label for="nom" class="form-label">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $auteur['nom']?>">

        <label for="prenom" class="form-label">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $auteur['prenom']?>">

        <label for="nom_de_plume" class="form-label">Nom de plume : </label>
        <input type="text" class="form-control" name="nom_de_plume" id="nom_de_plume" value="<?= $auteur['nom_de_plume']?>">

        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $auteur['adresse']?>">

        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $auteur['ville']?>">

        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal" value="<?= $auteur['code_postal']?>">

        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail" value="<?= $auteur['mail']?>">

        <label for="numero" class="form-label">Numero : </label>
        <input type="text" class="form-control" name="numero" id="numero" value="<?= $auteur['numero']?>">

        <label for="photo" class="form-label">Photo : </label>
        <input type="file" class="form-control" name="photo" id="photo">
        <input type="hidden" name="photo_hidden" value="<?= $auteur['photo']?>">

        <input type="submit" class="btn btn-success mt-5" name="modifier_auteur">
        <a href="<?= URL_ADMIN ?>auteur/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>