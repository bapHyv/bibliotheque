<?php

  include '../config/config.php';
  include '../config/bdd.php';
  include '../config/functions.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM utilisateur WHERE id = :id';
        $requete = $bdd->prepare($sql);
        $data = array(':id' => $id);
        $requete->execute($data);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
    }
  } else {
      header('location:' . URL_ADMIN . 'utilisateur/index.php');
      die;
  }

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Modifier <?= $utilisateur['prenom'] . ' ' . $utilisateur['nom'] ?></title>
  </head>
  <body>
    <div class="container">
    <h1 class="text-center mt-5">Modifier <?= $utilisateur['prenom'] . ' ' . $utilisateur['nom'] ?></h1>

    <?php
    
      if (isset($_SESSION['error_utilisateur']) && $_SESSION['error_utilisateur'] == true) {
        alert($_SESSION['message_error'], 'error');
        unset($_SESSION['error_utilisateur']);
        unset($_SESSION['message_error']);
    }?>

    <form action="<?= URL_ADMIN ?>utilisateur/action.php" method="POST" enctype="multipart/form-data">
    
        <input type="hidden" value="<?= $utilisateur['id'] ?>" name="id" id="id-utilsateur">
    
        <label for="nom" class="form-label">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $utilisateur['nom'] ?>">

        <label for="prenom" class="form-label">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $utilisateur['prenom'] ?>">

        <label for="pseudo" class="form-label">Pseudo : </label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?= $utilisateur['pseudo'] ?>">
        
        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail" value="<?= $utilisateur['mail'] ?>">

        <label for="mdp" class="form-label">Mot de passe : </label>
        <input type="text" class="form-control" name="mdp" id="mdp" value="<?= $utilisateur['mot_de_passe'] ?>">
        
        <label for="numero" class="form-label">Numero : </label>
        <input type="text" class="form-control" name="numero" id="numero" value="<?= $utilisateur['num_telephone'] ?>">

        <label for="avatar" class="form-label">Avatar : </label>
        <input type="file" class="form-control" name="avatar" id="avatar">
                
        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $utilisateur['adresse'] ?>">

        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $utilisateur['ville'] ?>">

        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal" value="<?= $utilisateur['code_postal'] ?>">

        <input type="submit" class="btn btn-success mt-5" name="modifier_utilisateur">
        <a href="<?= URL_ADMIN ?>utilisateur/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>