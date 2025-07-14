<?php
session_start();

$categories = $_SESSION['filtre_categories'];
$titre = $_SESSION['filtre_titre'];
$empruntes = $_SESSION['filtre_empruntes'];
$non_empruntes = $_SESSION['filtre_non_empruntes'];
$id_categorie = $_SESSION['filtre_id_categorie'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Filtrer les objets par catégorie</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4"><i class="bi bi-filter"></i> Filtrer les objets par catégorie</h1>

        <form method="get" action="traitement_filtre.php" class="row g-3 justify-content-center mb-4">
            <div class="col-auto">
                <label for="categorie" class="col-form-label">Choisir une catégorie :</label>
            </div>
            <div class="col-auto">
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">-- Toutes les catégories --</option>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= $cat['id_categorie'] ?>" <?= ($id_categorie == $cat['id_categorie']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nom_categorie']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filtrer</button>
            </div>
        </form>

        <h2 class="text-center"><?= $titre ?></h2>

        <h3 class="mt-4 text-danger"><i class="bi bi-x-circle"></i> Objets empruntés</h3>
        <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-danger">
                <tr>
                    <th>Nom de l'objet</th>
                    <th>Catégorie</th>
                    <th>Propriétaire</th>
                    <th>Emprunteur</th>
                    <th>Date d'emprunt</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($empruntes) === 0) { ?>
                <tr><td colspan="5" class="text-center">Aucun objet emprunté actuellement.</td></tr>
            <?php } else { ?>
                <?php foreach ($empruntes as $objet) { ?>
                    <tr>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_proprietaire']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_emprunteur']) ?></td>
                        <td><?= htmlspecialchars($objet['date_emprunt']) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
        </div>

        <h3 class="mt-4 text-success"><i class="bi bi-check-circle"></i> Objets disponibles</h3>
        <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th>Nom de l'objet</th>
                    <th>Catégorie</th>
                    <th>Propriétaire</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($non_empruntes) === 0) { ?>
                <tr><td colspan="3" class="text-center">Aucun objet disponible actuellement.</td></tr>
            <?php } else { ?>
                <?php foreach ($non_empruntes as $objet) { ?>
                    <tr>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_proprietaire']) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
        </div>

        <div class="text-center mt-4">
            <a href="accueil.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>