<?php

  include '../config/config.php';
  include '../config/bdd.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM livre WHERE id = :id';
        $requete = $bdd->prepare($sql);
        $data = array(':id' => $id);
        $requete->execute($data);
        $livre = $requete->fetch(PDO::FETCH_ASSOC);
    }
  } else {
      header('location:' . URL_ADMIN . 'livre/index.php');
      die;
  }

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Modifier un livre</title>
  </head>
  <body>
    <div class="container">
    <h1 class="text-center mt-5">Modifier un livre</h1>
    <form action="<?= URL_ADMIN ?>livre/action.php" method="POST" enctype='multipart/form-data'>
    
        <input type="hidden" value="<?= $livre['id'] ?>" name="id" id="id-utilsateur">
    
        <label for="num_ISBN" class="form-label">Dénomination : </label>
        <input type="text" class="form-control" name="num_ISBN" id="num_ISBN" value="<?= $livre['num_ISBN'] ?>">

        <label for="titre" class="form-label">Titre : </label>
        <input type="text" class="form-control" name="titre" id="titre" value="<?= $livre['titre'] ?>">

        <label for="illustration" class="form-label">Illustration : </label>
        <input type="file" class="form-control" name="illustration" id="illustration" value="<?= $livre['illustration'] ?>">

        <label for="resume" class="form-label">Résumé : </label>
        <input type="text" class="form-control" name="resume" id="resume" value="<?= $livre['resume'] ?>">

        <label for="prix" class="form-label">Prix : </label>
        <input type="text" class="form-control" name="prix" id="prix" value="<?= $livre['prix'] ?>">

        <label for="nb_pages" class="form-label">Nombre de pages : </label>
        <input type="text" class="form-control" name="nb_pages" id="nb_pages" value="<?= $livre['nb_pages'] ?>">

        <label for="disponibilite" class="form-label">Disponibilité : </label>
        <input type="text" class="form-control" name="disponibilite" id="disponibilite" value="<?= $livre['disponibilite'] ?>">

        <input type="submit" class="btn btn-success mt-5" name="modifier_livre">
        <a href="<?= URL_ADMIN ?>livre/index.php" class="btn btn-danger mt-5">Annuler</a>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>