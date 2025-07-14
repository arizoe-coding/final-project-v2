<?php
session_start();
require_once '../inc/function.php';

$objet = $_SESSION['objet_infos'] ?? null;
$images = $_SESSION['objet_images'] ?? [];
$historiques = $_SESSION['objet_historiques'] ?? [];

if (!$objet) {
    echo "Objet introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'objet</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Détail de l'objet</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h3><?= htmlspecialchars($objet['nom_objet']) ?></h3>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
            <p><strong>Propriétaire :</strong> <?= htmlspecialchars($objet['nom_proprietaire']) ?></p>
        </div>
        <?php if (!empty($images)) { ?>
            <div class="card-footer">
                <strong>Images :</strong><br>
                <?php foreach ($images as $img) { ?>
                    <div style="display:inline-block; position:relative; margin-right:10px;">
                        <img src="../uploads/<?= htmlspecialchars($img['nom_image']) ?>" alt="Image" style="width:100px; height:100px; object-fit:cover;">
                        <form action="traitement_supp.php" method="post" style="position:absolute; top:5px; right:5px;">
                            <input type="hidden" name="id_image" value="<?= $img['id_image'] ?>">
                            <input type="hidden" name="id_objet" value="<?= $objet['id_objet'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette image ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <h4>Historique des emprunts</h4>
    <table class="table table-bordered table-striped align-middle">
        <tr>
            <th>Emprunteur</th>
            <th>Date d'emprunt</th>
            <th>Date de retour</th>
        </tr>
        <?php if (empty($historiques)) { ?>
            <tr><td colspan="3" class="text-center">Aucun emprunt pour cet objet.</td></tr>
        <?php } else { ?>
            <?php foreach ($historiques as $histo) { ?>
                <tr>
                    <td><?= htmlspecialchars($histo['nom_emprunteur']) ?></td>
                    <td><?= htmlspecialchars($histo['date_emprunt']) ?></td>
                    <td><?= htmlspecialchars($histo['date_retour']) ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <div class="mt-3">
        <a href="accueil.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</div>
</body>
</html>