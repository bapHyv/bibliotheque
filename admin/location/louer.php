<?php 

    include '../config/config.php';
    include '../config/bdd.php';
    include '../config/functions.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $sql = "SELECT * FROM livre WHERE id = :id";
            $requete = $bdd->prepare($sql);
            $data = [':id' => $id];
            $livre = $requete->execute($data);
            $livre = $requete->fetch(PDO::FETCH_ASSOC);
        }
    }

    $sqlUsager = "SELECT * FROM usager";
    $requeteUsager = $bdd->query($sqlUsager);
    $usagers = $requeteUsager->fetchAll(PDO::FETCH_ASSOC);

    $sqlEtat = "SELECT * FROM etat";
    $requeteEtat = $bdd->query($sqlEtat);
    $etats = $requeteEtat->fetchAll(PDO::FETCH_ASSOC);

    $sqlEtatLivre = 
    "SELECT * FROM etat_livre 
    INNER JOIN livre ON livre.id = etat_livre.id_livre 
    INNER JOIN etat ON etat.id = etat_livre.id_etat
    WHERE id_livre = :id";
    $requeteEtatLivre = $bdd->prepare($sqlEtatLivre);
    $id = intval($_GET['id']);
    $data = [':id' => $id];
    $requeteEtatLivre->execute($data);
    $etatLivre = $requeteEtatLivre->fetch(PDO::FETCH_ASSOC);
?>

<?php 
            $styleSheet = '<link rel="stylesheet" href="' . URL_ADMIN . 'css/liste-livres.css">';
            $title = 'Location de ' . $livre['titre'];
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
<h1 class="text-center mt-5">Louer <?=$livre['titre']?></h1>

<?php

if (isset($_SESSION['error_livre']) && $_SESSION['error_livre'] == true) {
  alert($_SESSION['message_error'], 'danger');
  unset($_SESSION['error_livre']);
  unset($_SESSION['message_error']);
}?>

<div class="container-fluid">
    <a href="<?= URL_ADMIN?>location/index.php" class="btn btn-info">Retour</a>
                    <div class="mt-5">
                        <div style="display: flex;">
                            <img style="height: 600px;" src="<?= URL_ADMIN?>/img/livre/<?= $livre['illustration']?>" alt="">
                            <div class="ml-5 mr-5">
                                <p class="resume"><b>Résumé: </b><?= $livre['resume']?></p>
                                <p><b>Prix:</b> <?= $livre['prix']?></p>
                                <p><b>Nombre de pages:</b> <?= $livre['nb_pages']?></p>
                                <p><b>Date d'achat:</b> <?= $livre['date_achat']?></p>
                            </div>
                        </div>
                            
                    </div>

                </div>

<form action="<?= URL_ADMIN ?>location/action.php" method="POST" enctype='multipart/form-data'>

    <input type="hidden" value="<?= $livre['id'] ?>" name="id" id="id-utilsateur">

    <br>
    <label for="usager">Usager:</label>
    <select name="usager" id="usager">
        <option value="">-- VEUILLEZ SELECTIONNER UN USAGER --</option>
        <?php foreach ($usagers as $usager) :?>
            <option value="<?= $usager['id']?>"><?=$usager['nom'] . ' ' . $usager['prenom']?></option>
        <?php endforeach ?>
    </select>
    <br>
    <label for="etat">État:</label>
    <select name="etat" id="etat">
        <option value="<?= $etatLivre['id_etat']?>"><?=$etatLivre['libelle']?></option>
        <?php foreach ($etats as $etat) :?>
            <?php if ($etat['libelle'] != $etatLivre['libelle']) :?>
              <option value="<?=$etat['id']?>"><?=$etat['libelle']?></option>
            <?php endif ?>
          <?php endforeach ?>
    </select>
    <br>
    <input type="submit" class="btn btn-success mt-5" name="louer_livre" value="Envoyer">
    <a href="<?= URL_ADMIN ?>location/index.php" class="btn btn-danger mt-5">Annuler</a>

</form>
</div>
</div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>