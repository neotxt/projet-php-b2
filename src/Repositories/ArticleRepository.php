<?php

namespace Repositories;

use PDO;
use Models\Article;

class ArticleRepository implements Repository
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function create(object $article)
    {
        // Créer un nouvel article dans la bdd
    }

    public function read(int $id)
    {

        $sql = 'SELECT * FROM Vetements WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $articlesData = $this->fetchAllArticles();

        return $this->createArticleObjects($articlesData);
    }

    private function fetchAllArticles()
    {
        $sql = 'SELECT * FROM Vetements';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function createArticleObjects(array $articlesData)
    {
        $articleObjects = [];
        foreach ($articlesData as $article) {
            $articleObjects[] = new Article(
                $article['id'],
                $article['titre'],
                $article['prix'],
                $article['description'],
                $article['image']
            );
        }
        return $articleObjects;
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
