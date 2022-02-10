<?php
  include '../config/config.php';
  include '../config/function.php';
?>

<?php
    $title = 'Ajouter une categorie';
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
    <h1 class="text-center mt-5">Ajouter un categorie</h1>

    <?php if (
        isset($_SESSION['error_categorie']) &&
        $_SESSION['error_categorie'] == true
    ) {
        alert($_SESSION['message_error'], 'danger');
        unset($_SESSION['error_categorie']);
        unset($_SESSION['message_error']);
    }?>

    <form action="<?= URL_ADMIN ?>categorie/action.php" method="POST">

        <label for="libelle" class="form-label">Libellé : </label>
        <input type="text" class="form-control" name="libelle" id="libelle">

        <input type="submit" class="btn btn-success mt-5" name="ajouter_categorie">
        <a href="<?= URL_ADMIN ?>categorie/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>