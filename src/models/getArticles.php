<?php
namespace Models;


class getArticles {

 // Récupère tous les vêtements depuis la base de données
    /**
     * Récupère tous les vêtements depuis la base de données Vetements
     * @return array Liste des vêtements (chaque ligne est un tableau associatif)
     */
    public static function getAll() {
        // Charger la classe Database (connexion PDO)
        require_once __DIR__ . '/../config/database.php';
        // Créer une instance de la classe Database du namespace Config
        $db = new \Config\Database();
        // Récupérer la connexion PDO à la base de données
        $conn = $db->getConnection();
        // Exécuter la requête SQL pour obtenir tous les vêtements
        $stmt = $conn->query('SELECT * FROM Vetements');
        //Retourner tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    

}
