<?php

include '../config/config.php';
include '../config/bdd.php';
include '../config/functions.php';

if (isset($_POST['louer_livre'])) {
    $id_livre = intval($_POST['id']);
    $id_usager = intval($_POST['usager']);
    $etat = intval($_POST['etat']);
    $statut = 1;

    // CHANGE DISPONIBILITE DANS TABLE LIVRE
    $sql = 'UPDATE livre SET disponibilite = 0 WHERE id = :id LIMIT 1';
    $requete = $bdd->prepare($sql);
    $data = [':id' => $id_livre,];
    $requete->execute($data);

    // INSERT LES VALEURS DANS LA TABLE location
    $sql = "INSERT INTO location VALUES (NULL, :id_usager, :id_livre, NOW(), NULL, :etat_debut, NULL, :statut)";
    $requete = $bdd->prepare($sql);
    $data = array(
        ':id_usager' => $id_usager,
        ':id_livre' => $id_livre,
        ':etat_debut' => $etat,
        ':statut' => $statut
        );
    if ($requete->execute($data)) {
        header('location:' . URL_ADMIN . 'location/louer.php');
        die;
    } else {
        header('location:' . URL_ADMIN . 'location/louer.php');
        die;
    }

    $success_message = 'Vous avez bien loué le livre n°= "<b>' . $id_livre . '</b>"';

    executeSqlUtilisateurAction('id_location', $bdd, action_ajouter($bdd, 1), 'location/', 'error_location', $success_message);
}

if (isset($_POST['retourner_livre'])) {
    $id = intval($_POST['id']);
    $etat_retour = intval($_POST['etat']);

    // JE MET LE LIVRE DISPONIBLE DANS LA TABLE LIVRE
    $sql = 'UPDATE livre SET disponibilite = 1 WHERE id = :id LIMIT 1';
    $requete = $bdd->prepare($sql);
    $data = [':id' => $id];
    $requete->execute($data);

    $sqlEtat = 'UPDATE etat_livre SET id_etat = :etat_retour WHERE id_livre = :id LIMIT 1';
    $requeteEtat = $bdd->prepare($sqlEtat);
    $dataEtat = [':id' => $id, ':etat_retour' => $etat_retour];
    $requeteEtat->execute($dataEtat);

    // JE COMPLETE LA LOCATION EN Y AJOUTANT LA DATE DE FIN, L'ÉTAT DE RETOUR DU LIVRE ET LE STATUT À 0
    $sqlUpdate = "UPDATE location SET date_fin = NOW(), etat_retour = :etat_retour, statut = 0 WHERE id_livre = :id";
    $requeteUpdate = $bdd->prepare($sqlUpdate);
    $dataUpdate = [':id' => $id, ':etat_retour' => $etat_retour];
    if($requeteUpdate->execute($dataUpdate)) {
        header('location:' . URL_ADMIN . 'location/index.php');
        die;
    } else {
        header('location:' . URL_ADMIN . 'location/retourner.php');
        die;
    }

    $success_message = 'Vous avez bien retourné le livre n°= "<b>' . $id . '</b>"';
        
    executeSqlUtilisateurAction('id_location', $bdd, action_modifier_supprimer(2, $id), 'location/', 'error_location', $success_message);
}

?>
