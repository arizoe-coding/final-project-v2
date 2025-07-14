<?php
session_start();
require_once '../inc/function.php';

// Récupération des catégories
$categories = get_all_categories();

// Récupération de la catégorie sélectionnée
$id_categorie = isset($_GET['categorie']) ? intval($_GET['categorie']) : 0;
if ($id_categorie > 0) {
    $objets = get_objets_by_categorie_with_emprunt($id_categorie);
    $titre = "Objets de la catégorie : " . htmlspecialchars(
        $categories[array_search($id_categorie, array_column($categories, 'id_categorie'))]['nom_categorie']
    );
} else {
    $objets = get_objets_with_emprunt();
    $titre = "Tous les objets";
}

// Séparation objets empruntés / non empruntés
$empruntes = [];
$non_empruntes = [];
foreach ($objets as $objet) {
    if ($objet['emprunte']) {
        $empruntes[] = $objet;
    } else {
        $non_empruntes[] = $objet;
    }
}

// Stockage en session
$_SESSION['filtre_categories'] = $categories;
$_SESSION['filtre_titre'] = $titre;
$_SESSION['filtre_empruntes'] = $empruntes;
$_SESSION['filtre_non_empruntes'] = $non_empruntes;
$_SESSION['filtre_id_categorie'] = $id_categorie;

// Redirection vers la page d'affichage
header('Location: filtre.php');
exit;
?>