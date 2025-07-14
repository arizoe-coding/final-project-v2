<?php
session_start();
require_once '../inc/function.php';
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
$categories = get_all_categories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un objet</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4"><i class="bi bi-plus-circle"></i> Ajouter un objet</h1>
                        <form action="traitement_ajout_objet.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nom_objet" class="form-label">Nom de l'objet :</label>
                                <input type="text" id="nom_objet" name="nom_objet" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_categorie" class="form-label">Catégorie :</label>
                                <select id="id_categorie" name="id_categorie" class="form-select" required>
                                    <option value="">--Choisir--</option>
                                    <?php foreach ($categories as $cat) { ?>
                                        <option value="<?= $cat['id_categorie'] ?>"><?= htmlspecialchars($cat['nom_categorie']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="id_membre" value="<?= $_SESSION['id_user'] ?>">
                            <div class="mb-3">
                                <label for="image_objet" class="form-label">Image de l'objet :</label>
                                <input type="file" id="image_objet" name="image_objet" class="form-control" accept="image/*" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center"><a href="accueil.php">Retour à l'accueil</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>