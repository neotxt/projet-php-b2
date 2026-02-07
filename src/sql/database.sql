-- Table principale des utilisateurs
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des rôles possibles
CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE  
);

-- Table de liaison utilisateurs -> rôles (plusieurs rôles possibles par utilisateur)
CREATE TABLE UserRoles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY(user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES Roles(id) ON DELETE CASCADE
);

CREATE TABLE Vetements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vendeur INT NOT NULL,
    titre VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    taille VARCHAR(20),
    marque VARCHAR(50),
    etat VARCHAR(30), -- neuf, très bon état, etc.
    image BLOB not null, -- URL ou chemin
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en vente', 'vendu') DEFAULT 'en vente',

    FOREIGN KEY (id_vendeur) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Stock (
    id_item INT PRIMARY KEY,
    quantite INT NOT NULL CHECK (quantite >= 0),
    FOREIGN KEY (id_item) REFERENCES Vetements(id) ON DELETE CASCADE
);

CREATE TABLE Orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_acheteur INT NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut_commande ENUM('en attente', 'payée', 'expédiée','annulée'),

    FOREIGN KEY (id_acheteur) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Order_Items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL,
    id_item INT NOT NULL,
    quantite INT NOT NULL CHECK (quantite > 0),
    prix_unitaire DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (id_order) REFERENCES Orders(id) ON DELETE CASCADE,
    FOREIGN KEY (id_item) REFERENCES Vetements(id) ON DELETE CASCADE
);

CREATE TABLE Invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_acheteur INT NOT NULL,
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    montant DECIMAL(10,2) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,

    FOREIGN KEY (id_acheteur) REFERENCES Users(id) ON DELETE CASCADE
);

ALTER TABLE Invoice
ADD id_order INT NOT NULL,
ADD FOREIGN KEY (id_order) REFERENCES Orders(id) ON DELETE CASCADE;



-- Insérer les rôles possibles
INSERT INTO Roles (role_name) VALUES ('acheteur'), ('vendeur');


INSERT INTO Vetements (id_vendeur, titre, description, prix, categorie, taille, marque, etat, image) VALUES
(1, 'Jean slim', 'Jean coupe slim bleu', 10.99, 'pantalon', 'M', 'Levi\'s', 'bon état', 'https://tse3.mm.bing.net/th/id/OIP._W2bBZPojv_7wUhRHOTTCAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3'),
(1, 'Pantalon cargo', 'Pantalon cargo beige', 15.99, 'pantalon', 'L', 'H&M', 'très bon état', 'https://media.atlasformen.com/webmedia/1080by1242/be/e2/44/bee24439ed128eaadb7db412d9a855ae.jpg?w=1200'),
(1, 'Jogging noir', 'Jogging noir confortable', 12.99, 'pantalon', 'S', 'Nike', 'bon état', 'https://tse4.mm.bing.net/th/id/OIP.63i-viB86CMhEcRIM1IQUwHaJ3?rs=1&pid=ImgDetMain&o=7&rm=3');