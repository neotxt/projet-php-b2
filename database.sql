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
