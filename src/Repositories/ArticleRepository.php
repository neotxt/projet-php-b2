<?php

namespace Repositories;

class ArticleRepository implements Repository
{
    public function getLastsArticles($limit = 12)
    {
        $stmt = $this->conn->prepare('SELECT * FROM clothes ORDER BY publish_date DESC LIMIT ?');
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $articles = [];
        foreach ($rows as $row) {
            $articles[] = new \Models\Article(
                $row['id'],
                $row['seller_id'],
                $row['title'],
                $row['description'],
                $row['price'],
                $row['category'],
                $row['size'],
                $row['brand'],
                $row['condition'],
                $row['image']
            );
        }
        return $articles;
    }

    // PDO connection
    private $conn;

    public function __construct($pdo)
    {
        
        $this->conn = $pdo;
    }

    public function create(object $article)
    {
        // Créer un nouvel article dans la bdd
    }

    public function read(int $id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM clothes WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) return null;
        return new \Models\Article(
            $row['id'],
            $row['seller_id'],
            $row['title'],
            $row['description'],
            $row['price'],
            $row['category'],
            $row['size'],
            $row['brand'],
            $row['condition'],
            $row['image']
        );
    }

    public function getAll()
    {
        $stmt = $this->conn->query('SELECT * FROM clothes');
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $articles = [];
        foreach ($rows as $row) {
            $articles[] = new \Models\Article(
                $row['id'],
                $row['seller_id'],
                $row['title'],
                $row['description'],
                $row['price'],
                $row['category'],
                $row['size'],
                $row['brand'],
                $row['condition'],
                $row['image']
            );
        }
        return $articles;
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
