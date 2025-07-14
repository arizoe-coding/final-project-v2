<?php
session_start();
require_once '../inc/function.php';

$objets = get_objets_with_emprunt();
$categories = get_all_categories();

$empruntes = [];
$non_empruntes = [];
foreach ($objets as $objet) {
    if ($objet['emprunte']) {
        $empruntes[] = $objet;
    } else {
        $non_empruntes[] = $objet;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4">Liste des objets</h1>

        <form method="get" action="traitement_filtre.php" class="row g-3 justify-content-center mb-4">
            <div class="col-auto">
                <label for="categorie" class="col-form-label">Choisir une catégorie :</label>
            </div>
            <div class="col-auto">
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">-- Toutes les catégories --</option>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= $cat['id_categorie'] ?>">
                            <?= htmlspecialchars($cat['nom_categorie']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filtrer</button>
            </div>
        </form>

        <h2 class="text-danger"><i class="bi bi-x-circle"></i> Objets empruntés</h2>
        <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <tr>
                <th>Image</th>
                <th>Nom de l'objet</th>
                <th>Catégorie</th>
                <th>Propriétaire</th>
                <th>Emprunteur</th>
                <th>Date d'emprunt</th>
            </tr>
            <?php if (count($empruntes) === 0) {?>
                <tr><td colspan="6" class="text-center">Aucun objet emprunté actuellement.</td></tr>
            <?php } else { ?>
                <?php foreach ($empruntes as $objet) { 
                    $img = get_images_principale_of_objects($objet['id_objet']);
                    $img_src = $img ? '../uploads/' . htmlspecialchars($img['nom_image']) : '';
                ?>
                    <tr onclick="window.location.href='traitement_affichage_objet.php?id=<?= $objet['id_objet'] ?>'" style="cursor:pointer;">
                        <td><img src="<?= $img_src ?>" alt="Image" style="width:60px; height:60px; object-fit:cover;"></td>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_proprietaire']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_emprunteur']) ?></td>
                        <td><?= htmlspecialchars($objet['date_emprunt']) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
        </div>

        <h2 class="text-success mt-4"><i class="bi bi-check-circle"></i> Objets disponibles</h2>
        <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <tr>
                <th>Image</th>
                <th>Nom de l'objet</th>
                <th>Catégorie</th>
                <th>Propriétaire</th>
            </tr>
            <?php if (count($non_empruntes) === 0) { ?>
                <tr><td colspan="4" class="text-center">Aucun objet disponible actuellement.</td></tr>
            <?php } else { ?>
                <?php foreach ($non_empruntes as $objet) { 
                    $img = get_images_principale_of_objects($objet['id_objet']);
                    $img_src = $img ? '../uploads/' . htmlspecialchars($img['nom_image']) : '';
                ?>
                    <tr onclick="window.location.href='traitement_affichage_objet.php?id=<?= $objet['id_objet'] ?>'" style="cursor:pointer;">
                        <td><img src="<?= $img_src ?>" alt="Image" style="width:60px; height:60px; object-fit:cover;"></td>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_proprietaire']) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-person-plus"></i> Ajouter un membre</a>
            <a href="ajout_objet.php" class="btn btn-secondary"><i class="bi bi-person-plus"></i> Ajouter un objet</a>
            <a href="login.php" class="btn btn-outline-primary ms-2"><i class="bi bi-box-arrow-in-right"></i> Se connecter</a>
        </div>
    </div>
</body>
</html>