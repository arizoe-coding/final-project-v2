CREATE DATABASE IF NOT EXISTS emprunt;
USE emprunt;

-- Table: membre
CREATE TABLE IF NOT EXISTS emp_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre ENUM('H', 'F', 'Autre') NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    ville VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

-- Table: categorie_objet
CREATE TABLE IF NOT EXISTS emp_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

-- Table: objet
CREATE TABLE IF NOT EXISTS emp_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES emp_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre)
);

-- Table: images_objet
CREATE TABLE IF NOT EXISTS emp_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES emp_objet(id_objet)
);

-- Table: emprunt
CREATE TABLE IF NOT EXISTS emp_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES emp_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre)
);

-- 4 membres
INSERT INTO emp_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice Martin', '1990-05-12', 'F', 'alice.martin@email.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bob Dupont', '1985-08-23', 'H', 'bob.dupont@email.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Claire Dubois', '1992-11-03', 'F', 'claire.dubois@email.com', 'Marseille', 'mdp3', 'claire.jpg'),
('David Leroy', '1988-02-17', 'H', 'david.leroy@email.com', 'Toulouse', 'mdp4', 'david.jpg');

-- 4 catégories
INSERT INTO emp_categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

-- 10 objets par membre (40 objets au total, répartis sur les catégories)
INSERT INTO emp_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Lisseur', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Mixeur', 4, 1),
('Batteur', 4, 1),
('Tondeuse', 1, 1),
('Pinceau', 2, 1),
('Casserole', 4, 1),

('Ponceuse', 2, 2),
('Scie sauteuse', 2, 2),
('Tournevis électrique', 2, 2),
('Robot pâtissier', 4, 2),
('Cafetière', 4, 2),
('Grille-pain', 4, 2),
('Fer à lisser', 1, 2),
('Tondeuse barbe', 1, 2),
('Pompe à vélo', 3, 2),
('Clé dynamométrique', 3, 2),

('Aspirateur', 1, 3),
('Brosse coiffante', 1, 3),
('Perceuse-visseuse', 2, 3),
('Marteau', 2, 3),
('Clé plate', 3, 3),
('Fouet électrique', 4, 3),
('Blender', 4, 3),
('Tondeuse cheveux', 1, 3),
('Pince multiprise', 2, 3),
('Poêle', 4, 3),

('Polisseuse', 1, 4),
('Fer à boucler', 1, 4),
('Scie circulaire', 2, 4),
('Tournevis plat', 2, 4),
('Clé Allen', 3, 4),
('Cocotte-minute', 4, 4),
('Batteur électrique', 4, 4),
('Tondeuse nez', 1, 4),
('Pince coupante', 2, 4),
('Marmite', 4, 4);

-- 10 emprunts (exemple, objets et membres variés)
INSERT INTO emp_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2024-07-01', '2025-07-05'),
(5, 3, '2023-07-02', '2025-07-05'),
(12, 1, '2022-07-03', '2025-07-10'),
(15, 4, '2021-07-04', '2025-07-05'),
(22, 2, '2020-07-05', '2025-07-08'),
(28, 1, '2020-07-06', '2025-07-05'),
(31, 3, '2020-07-07', '2025-07-09'),
(35, 2, '2021-07-08', '2025-07-05'),
(39, 1, '2022-07-09', '2025-07-12'),
(40, 4, '2023-07-10', '2025-07-05');