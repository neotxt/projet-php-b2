<?php

namespace Repositories;

class ArticleRepository implements Repository
{
    // Connexion PDO à la base de données
    private $conn;

    public function __construct($db = null)
    {
        // Réutilise la connexion Database ou en crée une nouvelle
        if ($db === null) {
            $db = new \Config\Database();
        }
        $this->conn = $db->getConnection();
    }

    public function create(object $article)
    {
        // Créer un nouvel article dans la bdd
    }

    public function read(int $id)
    {
        // Prépare la requête SQL pour obtenir le vêtement par son id
        $stmt = $this->conn->prepare('SELECT * FROM Vetements WHERE id = ?');
        // Exécute la requête avec l'id fourni
        $stmt->execute([$id]);
        // Récupère le résultat sous forme de tableau associatif
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    public function getAll()
    {
        // Exécute la requête SQL pour obtenir tous les vêtements
        $stmt = $this->conn->query('SELECT * FROM Vetements');
        // Retourne tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update(object $article)
    {
        // Met à jour les informations d'un article dans la bdd
    }

    public function delete(int $id)
    {
        // Supprime un article dans la bdd
    }
}
