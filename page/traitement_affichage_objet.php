<?php
    session_start();
    require_once '../inc/function.php';

    if (!isset($_GET['id'])) {
        header('Location: accueil.php');
        exit;
    }

    $id_objet = intval($_GET['id']);

    // Récupérer les infos de l'objet
    $objet = get_objet_by_id($id_objet);

    // Récupérer les images de l'objet
    $images = get_images_of_objects($id_objet);

    // Récupérer l'historique des emprunts
    $historiques = get_historique_emprunts_objet($id_objet);

    // Stocker en session pour affichage
    $_SESSION['objet_infos'] = $objet;
    $_SESSION['objet_images'] = $images;
    $_SESSION['objet_historiques'] = $historiques;

    // Rediriger vers la page d'affichage
    header('Location: affichage_objet.php');
    exit;
?>