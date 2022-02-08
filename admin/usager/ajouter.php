<?php
  include '../config/config.php'
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ajouter un usager</title>
  </head>
  <body>
    <div class="container">
    <h1 class="text-center mt-5">Ajouter un usager</h1>
    <form action="<?= URL_ADMIN ?>usager/action.php" method="POST">
        <label for="nom" class="form-label">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom">

        <label for="prenom" class="form-label">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom">
        
        <label for="adresse" class="form-label">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse">
        
        <label for="ville" class="form-label">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville">
        
        <label for="code_postal" class="form-label">Code postal : </label>
        <input type="text" class="form-control" name="code_postal" id="code_postal">
        
        <label for="mail" class="form-label">Mail : </label>
        <input type="text" class="form-control" name="mail" id="mail">

        <input type="submit" class="btn btn-success mt-5" name="ajouter_usager">
        <a href="<?= URL_ADMIN ?>usager/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>