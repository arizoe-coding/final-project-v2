<?php
session_start();
require_once '../inc/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_objet = $_POST['nom_objet'];
    $id_categorie = intval($_POST['id_categorie']);
    $id_membre = intval($_POST['id_membre']);
    $nom_image = null;

    // Gestion de l'upload de l'image
    if (isset($_FILES['image_objet']) && $_FILES['image_objet']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $filename = uniqid() . '_' . basename($_FILES['image_objet']['name']);
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['image_objet']['tmp_name'], $target_file)) {
            $nom_image = $filename;
        }
    }

    // Ajout de l'objet
    $id_objet = ajout_objet($nom_objet, $id_categorie, $id_membre);

    // Ajout de l'image
    if ($id_objet && $nom_image) {
        ajout_image($id_objet, $nom_image);
        header('Location: accueil.php');
        exit;
    } else {
        echo "Erreur lors de l'ajout de l'objet ou de l'image.";
    }
} else {
    header('Location: ajout_objet.php');
    exit;
}