<?php
    session_start();
    require_once '../inc/function.php';

    if (isset($_POST['id_image']) && isset($_POST['id_objet'])) {
        $id_image = intval($_POST['id_image']);
        $id_objet = intval($_POST['id_objet']);
        supprimer_image($id_image);
        // On recharge l'affichage de l'objet
        header("Location: traitement_affichage_objet.php?id=$id_objet");
        exit;
    } else {
        header("Location: accueil.php");
        exit;
    }
?>