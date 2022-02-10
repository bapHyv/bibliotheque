<?php
  include '../config/config.php'; 
  include '../config/functions.php';
?>
  
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ajouter un auteur</title>
  </head>
  <body>
    <div class="container">
    <h1 class="text-center mt-5">Ajouter un auteur</h1>

    <?php if (
        isset($_SESSION['error_auteur']) &&
        $_SESSION['error_auteur'] == true
    ) {
        alert($_SESSION['message_error'], 'danger');
        unset($_SESSION['error_auteur']);
        unset($_SESSION['message_error']);
    }?>

    <form action="action.php" method="POST" enctype="multipart/form-data">
        <label for="nom" class="form-label">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom">

        <label for="prenom" class="form-label">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom">

        <label for="nom_de_plume" class="form-label">Nom de plume : </label>
        <input type="text" class="form-control" name="nom_de_plume" id="nom_de_plume">

        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse">

        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville">

        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal">

        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail">

        <label for="numero" class="form-label">Numero : </label>
        <input type="text" class="form-control" name="numero" id="numero">

        <label for="photo" class="form-label">Photo : </label>
        <input type="file" class="form-control" name="photo" id="photo">

        <input type="submit" class="btn btn-success mt-5" name="ajouter_auteur">
        <a href="<?= URL_ADMIN ?>auteur/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>