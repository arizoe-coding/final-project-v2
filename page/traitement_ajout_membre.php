<?php
require_once '../inc/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $mdp = $_POST['mdp'];
    $image_profil = null;

    // Gestion de l'upload de l'image
    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $filename = uniqid() . '_' . basename($_FILES['image_profil']['name']);
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $target_file)) {
            $image_profil = $filename;
        }
    }

    // Insertion dans la base
    $result = insert_user($nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil);

    if ($result) {
        $_SESSION['id_user'] = get_id_by_name($nom);
        header('Location: accueil.php');
    } else {
        echo "Erreur lors de l'ajout du membre.";
    }
} else {
    header('index.php');
    exit;
}
?>