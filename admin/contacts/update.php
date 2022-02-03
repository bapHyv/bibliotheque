<?php 
    // Modifier une prise de contact

    include 'bdd.php';

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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Modifier une prise de contact</title>
  </head>
  <body>
  <div class="container">
    <h1 class="text-center">Modifier une prise de contact</h1>
    <form action="action.php" method="POST">
        <input type="hidden" name="id" value = "<?= $contact['id'] ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom : </label>
            <input type="text" name="nom" class="form-control" id="nom" value="<?= $contact['nom'] ?>">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Mail : </label>
            <input type="mail" name="mail" class="form-control" id="mail" value="<?= $contact['mail'] ?>">
        </div>
        <div class="mb-3">
            <label for="objet" class="form-label">Objet : </label>
            <input type="text" name="objet" class="form-control" id="objet" value="<?= $contact['objet'] ?>">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message : </label>
            <textarea class="form-control" name="message" id="message" rows="3"><?= $contact['message'] ?></textarea>
        </div>
        <div class="mb-3 text-center">
            <input type="submit" name="btn_update_contact" class="btn btn-warning">
            <a href="http://localhost:8888/projet_bibliotheque_clone/admin/contacts/index.php" class="btn btn-primary">Annuler</a>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
