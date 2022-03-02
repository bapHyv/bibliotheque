<?php

  include '../config/config.php';
  include '../config/bdd.php';
  include '../config/functions.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM usager WHERE id = :id';
        $requete = $bdd->prepare($sql);
        $data = array(':id' => $id);
        $requete->execute($data);
        $usager = $requete->fetch(PDO::FETCH_ASSOC);
    }
  } else {
      header('location:' . URL_ADMIN . 'usager/index.php');
      die;
  }

?>
  
<?php
    $styleSheet = '';
    $title = 'Modifier ' . $usager['prenom'] . ' ' . $usager['nom'];
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
    <h1 class="text-center mt-5">Modifier <?= $usager['prenom'] . ' ' . $usager['nom']?></h1>
    <?php

      if (isset($_SESSION['error_usager']) && $_SESSION['error_usager'] == true) {
        alert($_SESSION['message_error'], 'danger');
        unset($_SESSION['error_usager']);
        unset($_SESSION['message_error']);
    }?>

    <form action="<?= URL_ADMIN ?>usager/action.php" method="POST">
    
        <input type="hidden" value="<?= $usager['id'] ?>" name="id" id="id-usager">
    
        <label for="nom" class="form-label">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $usager['nom'] ?>">

        <label for="prenom" class="form-label">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $usager['prenom'] ?>">
        
        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $usager['adresse'] ?>">
        
        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $usager['ville'] ?>">
        
        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal" value="<?= $usager['code_postal'] ?>">
        
        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail" value="<?= $usager['mail'] ?>">
        
        <input type="submit" class="btn btn-success mt-5" name="modifier_usager">
        <a href="<?= URL_ADMIN ?>usager/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>