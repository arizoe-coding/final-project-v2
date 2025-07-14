<?php
session_start();
require_once '../inc/function.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

$id_user = $_SESSION['id_user'];

$membre = get_membre_by_id($id_user);
$objets = get_objets_by_membre($id_user);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Mon profil</h1>
    <?php if ($membre) { ?>
        <div class="card mb-4">
            <div class="card-body">
                <h3><?= htmlspecialchars($membre['nom']) ?></h3>
                <p><strong>Email :</strong> <?= htmlspecialchars($membre['email']) ?></p>
                <p><strong>Ville :</strong> <?= htmlspecialchars($membre['ville']) ?></p>
                <p><strong>Date de naissance :</strong> <?= htmlspecialchars($membre['date_naissance']) ?></p>
                <p><strong>Genre :</strong> <?= htmlspecialchars($membre['genre']) ?></p>
                <?php if (!empty($membre['image_profil'])) { ?>
                    <img src="../uploads/<?= htmlspecialchars($membre['image_profil']) ?>" alt="Profil" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <h2 class="mt-4">Mes objets</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <tr>
                <th>Image</th>
                <th>Nom de l'objet</th>
                <th>Catégorie</th>
            </tr>
            <?php if (empty($objets)) { ?>
                <tr><td colspan="3" class="text-center">Aucun objet ajouté.</td></tr>
            <?php } else { ?>
                <?php foreach ($objets as $objet) { 
                    $img = get_images_principale_of_objects($objet['id_objet']);
                    $img_src = $img ? '../uploads/' . htmlspecialchars($img['nom_image']) : '';
                ?>
                    <tr onclick="window.location.href='traitement_affichage_objet.php?id=<?= $objet['id_objet'] ?>'" style="cursor:pointer;">
                        <td>
                            <?php if ($img_src) { ?>
                                <img src="<?= $img_src ?>" alt="Image" style="width:60px; height:60px; object-fit:cover;">
                            <?php } else { ?>
                                <span class="text-muted">Aucune image</span>
                            <?php } ?>
                        </td>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
    <div class="mt-3">
        <a href="accueil.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</div>
</body>
</html>