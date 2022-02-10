<?php

  include '../config/config.php';
  include '../config/bdd.php';
  include '../config/functions.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM editeur WHERE id = :id';
        $requete = $bdd->prepare($sql);
        $data = array(':id' => $id);
        $requete->execute($data);
        $editeur = $requete->fetch(PDO::FETCH_ASSOC);
    }
  } else {
      header('location:' . URL_ADMIN . 'editeur/index.php');
      die;
  }

?>

<?php
    $title = 'Modifier ' . $editeur['denomination'];
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
    <h1 class="text-center mt-5">Modifier <?= $editeur['denomination']?></h1>

    <?php
    
    if (isset($_SESSION['error_editeur']) && $_SESSION['error_editeur'] == true) {
      alert($_SESSION['message_error'], 'danger');
      unset($_SESSION['error_editeur']);
      unset($_SESSION['message_error']);
  }?>

    <form action="<?= URL_ADMIN ?>editeur/action.php" method="POST">
    
        <input type="hidden" value="<?= $editeur['id'] ?>" name="id" id="id-utilsateur">
    
        <label for="denomination" class="form-label">Dénomination : </label>
        <input type="text" class="form-control" name="denomination" id="denomination" value="<?= $editeur['denomination'] ?>">

        <label for="siret" class="form-label">SIRET : </label>
        <input type="text" class="form-control" name="siret" id="siret" value="<?= $editeur['siret'] ?>">

        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $editeur['adresse'] ?>">

        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $editeur['ville'] ?>">

        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal" value="<?= $editeur['code_postal'] ?>">

        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail" value="<?= $editeur['mail'] ?>">

        <label for="numero" class="form-label">Numero : </label>
        <input type="text" class="form-control" name="numero" id="numero" value="<?= $editeur['numero_tel'] ?>">

        <input type="submit" class="btn btn-success mt-5" name="modifier_editeur">
        <a href="<?= URL_ADMIN ?>editeur/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>