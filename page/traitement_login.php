<?php
session_start();
require_once '../inc/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    if (check_login($nom, $mdp)) {
        $_SESSION['id_user'] = get_id_by_name($nom);
        header('Location: accueil.php');
        exit;
    } else {
        header('Location: login.php?erreur=Nom ou mot de passe incorrect');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>