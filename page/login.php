<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4"><i class="bi bi-box-arrow-in-right"></i> Connexion</h2>
                        <?php
                        if (isset($_GET['erreur'])) {
                            echo '<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['erreur']).'</div>';
                        }
                        ?>
                        <form action="traitement_login.php" method="post">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" id="nom" name="nom" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe :</label>
                                <input type="password" id="mdp" name="mdp" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center">Pas encore de compte ? <a href="index.php">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>