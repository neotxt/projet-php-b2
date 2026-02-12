-- 1. Table des utilisateurs
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table des rôles
CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE  
);

-- 3. Table de liaison User-Role
CREATE TABLE UserRoles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY(user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES Roles(id) ON DELETE CASCADE
);

-- 4. Table des Articles
CREATE TABLE Articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    size VARCHAR(20),
    brand VARCHAR(50),
    `condition` VARCHAR(30), 
    image VARCHAR(255) NOT NULL, 
    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('en vente', 'vendu') DEFAULT 'en vente',

    FOREIGN KEY (seller_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- 5. Table Stock
CREATE TABLE Stock (
    item_id INT PRIMARY KEY,
    quantity INT NOT NULL CHECK (quantity >= 0),
    FOREIGN KEY (item_id) REFERENCES Articles(id) ON DELETE CASCADE
);

-- 6. Table Commandes
CREATE TABLE Orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_status ENUM('en attente', 'payée', 'expédiée','annulée'),

    FOREIGN KEY (buyer_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- 7. Détails commande
CREATE TABLE Order_Items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    unit_price DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Articles(id) ON DELETE CASCADE
);

-- 8. Factures
CREATE TABLE Invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_id INT NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10,2) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,

    FOREIGN KEY (buyer_id) REFERENCES Users(id) ON DELETE CASCADE
);

ALTER TABLE Invoice
ADD order_id INT NOT NULL,
ADD FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE;


-- =============================================
-- DONNÉES DE TEST
-- =============================================

-- 1. Insérer les rôles
INSERT INTO Roles (role_name) VALUES ('vendeur'), ('acheteur');

-- 2. Créer un utilisateur (Vendeur ID 1)
INSERT INTO Users (id, last_name, first_name, email, password) 
VALUES (1, 'Vendeur', 'Test', 'vendeur@test.com', '$2y$10$C.W..'); 

-- 3. Insérer les articles
INSERT INTO Articles (seller_id, title, description, price, category, size, brand, `condition`, image) VALUES
(1, 'jean Slim', 'jean slim bleu', 10.99, 'pantalon', 'M', 'Levi\'s', 'bon état', 'https://tse3.mm.bing.net/th/id/OIP._W2bBZPojv_7wUhRHOTTCAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3'),
(1, 'pantalon cargo', 'pentalon cargo beige', 15.99, 'pantalon', 'L', 'H&M', 'trés bon état', 'https://media.atlasformen.com/webmedia/1080by1242/be/e2/44/bee24439ed128eaadb7db412d9a855ae.jpg?w=1200'),
(1, 'jogging noir', 'jogging noir de sport', 12.99, 'pantalon', 'S', 'Nike', 'bon état', 'https://tse4.mm.bing.net/th/id/OIP.63i-viB86CMhEcRIM1IQUwHaJ3?rs=1&pid=ImgDetMain&o=7&rm=3');