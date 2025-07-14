<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4"><i class="bi bi-person-plus"></i> Ajouter un membre</h1>
                        <form action="traitement_ajout_membre.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" id="nom" name="nom" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance :</label>
                                <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre :</label>
                                <select id="genre" name="genre" class="form-select" required>
                                    <option value="">--Choisir--</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville :</label>
                                <input type="text" id="ville" name="ville" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe :</label>
                                <input type="password" id="mdp" name="mdp" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image_profil" class="form-label">Image de profil :</label>
                                <input type="file" id="image_profil" name="image_profil" class="form-control" accept="image/*">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success"><i class="bi bi-person-plus"></i> Ajouter</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center">Déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>