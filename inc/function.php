<?php 
    require_once 'connexion.php';

    function get_id_by_name($nom){
        $bdd = iconnect();
        $query = "SELECT id_membre FROM emp_membre WHERE nom ='$nom'";
        $result = mysqli_query($bdd, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['id_membre'] ?? null; // Retourne l'ID ou null si non trouvé
        } else {
            die('Erreur de requête : ' . mysqli_error($bdd));
        }
    }
    function check_if_user_exist($nom){
        $bdd = iconnect();
        if(get_id_by_name($nom) !== null){
            return true; // L'utilisateur existe
        } else {
            return false; // L'utilisateur n'existe pas
        }

    }

    function insert_user($nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil ) {
        $bdd = iconnect();
        // Construction de la requête SQL
        $query = "INSERT INTO emp_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) 
                VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";
        $result = mysqli_query($bdd, $query);
        if ($result) {
            return true;
        } else {
        
            return false;
        }
    }

    function check_login($nom, $mdp) {
        $bdd = iconnect();
        $query = "SELECT * FROM emp_membre WHERE nom = '$nom' AND mdp = '$mdp'";
        $result = mysqli_query($bdd, $query);
        if ($result && mysqli_num_rows($result) === 1) {
            return true;
        } else {
            return false;
        }
    }
    function get_all_objets() {
        $bdd = iconnect();
        $query = "SELECT o.*, c.nom_categorie, m.nom AS nom_proprietaire
                FROM emp_objet o
                JOIN emp_categorie_objet c ON o.id_categorie = c.id_categorie
                JOIN emp_membre m ON o.id_membre = m.id_membre";
        $result = mysqli_query($bdd, $query);
        $objets = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $objets[] = $row;
            }
        }
        return $objets;
    }

    // Vérification si un objet est emprunté (retourne true si emprunt en cours)
    function is_objet_emprunte($id_objet) {
        $bdd = iconnect();
        $query = "SELECT * FROM emp_emprunt WHERE id_objet = $id_objet AND date_retour IS NULL";
        $result = mysqli_query($bdd, $query);
        return ($result && mysqli_num_rows($result) > 0);
    }

    // Récupération de l'information d'emprunt en cours pour un objet (ou null si pas d'emprunt)
    function get_emprunt_info($id_objet) {
        $bdd = iconnect();
        $query = "SELECT e.*, m.nom AS nom_emprunteur
                FROM emp_emprunt e
                JOIN emp_membre m ON e.id_membre = m.id_membre
                WHERE e.id_objet = $id_objet AND e.date_retour IS NULL
                LIMIT 1";
        $result = mysqli_query($bdd, $query);
        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    // Affichage des objets avec date de retour si emprunt en cours (fonction utilitaire)
    function get_objets_with_emprunt() {
        $objets = get_all_objets();
        foreach ($objets as &$objet) {
            $emprunt = get_emprunt_info($objet['id_objet']);
            if ($emprunt) {
                $objet['emprunte'] = true;
                $objet['date_emprunt'] = $emprunt['date_emprunt'];
                $objet['nom_emprunteur'] = $emprunt['nom_emprunteur'];
            } else {
                $objet['emprunte'] = false;
                $objet['date_emprunt'] = null;
                $objet['nom_emprunteur'] = null;
            }
        }
        return $objets;
    }
    function get_all_categories() {
        $bdd = iconnect();
        $query = "SELECT * FROM emp_categorie_objet";
        $result = mysqli_query($bdd, $query);
        $categories = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    // Récupération des objets filtrés par catégorie (avec infos d'emprunt)
    function get_objets_by_categorie_with_emprunt($id_categorie) {
        $bdd = iconnect();
        $query = "SELECT o.*, c.nom_categorie, m.nom AS nom_proprietaire
                FROM emp_objet o
                JOIN emp_categorie_objet c ON o.id_categorie = c.id_categorie
                JOIN emp_membre m ON o.id_membre = m.id_membre
                WHERE o.id_categorie = $id_categorie";
        $result = mysqli_query($bdd, $query);
        $objets = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Ajoute infos d'emprunt
                $emprunt = get_emprunt_info($row['id_objet']);
                if ($emprunt) {
                    $row['emprunte'] = true;
                    $row['date_emprunt'] = $emprunt['date_emprunt'];
                    $row['nom_emprunteur'] = $emprunt['nom_emprunteur'];
                } else {
                    $row['emprunte'] = false;
                    $row['date_emprunt'] = null;
                    $row['nom_emprunteur'] = null;
                }
                $objets[] = $row;
            }
        }
        return $objets;
    }

    function get_images_of_objects($id_objet) {
        $bdd = iconnect();
        $query = "SELECT * FROM emp_images_objet WHERE id_objet = $id_objet";
        $result = mysqli_query($bdd, $query);
        $images = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $images[] = $row;
            }
        }
        return $images;
    }

    function get_default_images(){
        $bdd = iconnect();
        $query = "SELECT * FROM emp_images_objet WHERE nom_image = 'default.jpeg' LIMIT 1";
        $result = mysqli_query($bdd, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
            return $row;
            }
        }
        return null;
    }

    function count_images_of_objects($id_object){
        $bdd = iconnect();
        $query = "SELECT * FROM emp_images_objet WHERE id_objet = '$id_object'";
        $result = mysqli_query($bdd, $query);
        $count = 0;
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
            }
        }
        return $count;
    }

    function get_images_principale_of_objects($id_objet) {
       $images = get_images_of_objects($id_objet);
       if(count_images_of_objects($id_objet) === 0){
            return get_default_images();
       }
       return $images[0];
    }

    function ajout_objet($nom_objet, $id_categorie, $id_membre) {
        $bdd = iconnect();
        $query = "INSERT INTO emp_objet (nom_objet, id_categorie, id_membre) VALUES ('$nom_objet', $id_categorie, $id_membre)";
        $result = mysqli_query($bdd, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function ajout_image($id_objet, $nom_image) {
        $bdd = iconnect();
        $query = "INSERT INTO emp_images_objet (id_objet, nom_image) VALUES ($id_objet, '$nom_image')";
        $result = mysqli_query($bdd, $query);
        return $result;
    }
    function get_all_emprunt($id_object){
        $bdd = iconnect();
        $query = "SELECT * FROM emp_emprunt WHERE id_objet='$id_object' ";
        $result = mysqli_query($bdd,$query);
        $valiny = [];
        while ($row = mysqli_fetch_assoc($result)) {
            return $valiny[] = $row;

        }      
        return null;
    }

    function get_objet_by_id($id_objet) {
        $bdd = iconnect();
        $query = "SELECT o.*, c.nom_categorie, m.nom AS nom_proprietaire
                FROM emp_objet o
                JOIN emp_categorie_objet c ON o.id_categorie = c.id_categorie
                JOIN emp_membre m ON o.id_membre = m.id_membre
                WHERE o.id_objet = $id_objet
                LIMIT 1";
        $result = mysqli_query($bdd, $query);
        return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
    }

    function get_historique_emprunts_objet($id_objet) {
        $bdd = iconnect();
        $historiques = [];
        $query = "SELECT e.*, m.nom AS nom_emprunteur
                FROM emp_emprunt e
                JOIN emp_membre m ON e.id_membre = m.id_membre
                WHERE e.id_objet = $id_objet
                ORDER BY e.date_emprunt DESC";
        $result = mysqli_query($bdd, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $historiques[] = $row;
            }
        }
        return $historiques;
    }

    function supprimer_image($id_image) {
        $bdd = iconnect();
        // Récupérer le nom de l'image pour supprimer le fichier physique
        $query = "SELECT nom_image FROM emp_images_objet WHERE id_image = $id_image LIMIT 1";
        $result = mysqli_query($bdd, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $nom_image = $row['nom_image'];
            $file_path = "../uploads/" . $nom_image;
            if (file_exists($file_path) && $nom_image !== 'default.jpg' && $nom_image !== 'default.jpeg') {
                unlink($file_path);
            }
        }
        // Supprimer de la base
        $delete_query = "DELETE FROM emp_images_objet WHERE id_image = $id_image";
        return mysqli_query($bdd, $delete_query);
    }

?>