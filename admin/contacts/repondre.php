<?php

    include '../config/config.php';
    include '../config/bdd.php';

    if (isset($_GET['id'])){
      $id = intval($_GET['id']);
      // var_dump($id);
      if ($id > 0){
        // REQUETE SQL POUR RECUPERER LE CONTACT EN BDD
        $sql = "SELECT * FROM contact WHERE id = :id";
        // var_dump($sql);
        // EXECUTER LA REQUETE
        $requete = $bdd->prepare($sql);
        
        $data = array(
            ':id' => $id
        );

        $requete->execute($data);
        
        // RECUPERATION DES INFOS
        $contact = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($contact);
      }else{
        header('location:index.php');
        die;
      }
    }
?>

<?php
    $styleSheet = '';
    $title = 'Répondre à une prise de contact';
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
    <h1 class="text-center">Répondre à une prise de contact</h1>
    <p><b>Nom: </b><?= $contact['nom'] ?></p>
    <p><b>E-mail: </b><?= $contact['mail'] ?></p>
    <p><b>Objet: </b><?= $contact['objet'] ?></p>
    <p><b>Message: </b><?= $contact['message'] ?></p>
    <h2 class="mt-5 mb-3">Votre réponse:</h2>
    <form action="action.php" method="POST">
        <input type="hidden" name="id" value = "<?= $contact['id'] ?>">
        
        <div class="mb-3">
            <textarea class="form-control" name="message_reponse" id="message_reponse" rows="3"></textarea>
        </div>
        <div class="mb-3 text-center">
            <input type="submit" value="Répondre" name="btn_repondre_contact" class="btn btn-success">
            <a href="<?= URL_ADMIN ?>contacts/index.php" class="btn btn-danger">Annuler</a>
        </div>
    </form>
    </div>
    </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
