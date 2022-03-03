<?php

function alert($message, $color)
{
    ?>
    <div class="alert alert-<?= $color ?>">
        <?= $message ?>
    </div>

<?php
}

function action_ajouter($bdd, $id_action)
{
    $idUtilisateur = intval($_SESSION['logged_id']);
    $idAction = $id_action;

    $idCible = $bdd->LastInsertId();
    $idCible = intval($idCible);

    return [
        ':id_utilisateur' => $idUtilisateur,
        ':id_action' => $idAction,
        ':id_cible' => $idCible,
    ];
}

function action_modifier_supprimer($id_action, $id_cible)
{
    $idUtilisateur = intval($_SESSION['logged_id']);
    $idAction = $id_action;

    $idCible = intval($id_cible);

    return [
        ':id_utilisateur' => $idUtilisateur,
        ':id_action' => $idAction,
        ':id_cible' => $idCible,
    ];
}

function executeSqlUtilisateurAction($id_cible, $bdd, $functionUtilisateurAction, $location, $error_section, $success_message) {
    $sqlAction = "INSERT INTO utilisateur_action (id, date, id_utilisateur, id_action," . $id_cible . ") VALUES (NULL, NOW(), :id_utilisateur, :id_action, :id_cible)";
    
    $requeteAction = $bdd->prepare($sqlAction);
    
    $dataAction = $functionUtilisateurAction;
    
    if (!$requeteAction->execute($dataAction)) {
        $_SESSION[$error_section] = true;
        $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'action';
        header('location:' . URL_ADMIN . $location . 'ajouter.php');
        die;
    } else {
        $_SESSION[$error_section] = false;
        $_SESSION['message_error'] = $success_message;
        header('location:' . URL_ADMIN . $location . 'index.php');
        die;
    }
}
