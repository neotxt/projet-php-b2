<?php

namespace Repositories;

use PDO;

use Models\Article;

class ArticleRepository implements Repository
{
    private PDO $db;

    public function __construct($pdo)
    {

        $this->db = $pdo;
    }

    public function create(object $article)
    {
        $sql = "INSERT INTO Articles (seller_id, title, description, price, category, size, brand, `condition`, image)
                VALUES (:seller_id, :title, :description, :price, :category, :size, :brand, :condition, :image)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'seller_id' => $article->getSellerId(),
            'title' => $article->getTitle(),
            'description' => $article->getDescription(),
            'price' => $article->getPrice(),
            'category' => $article->getCategory(),
            'size' => $article->getSize(),
            'brand' => $article->getBrand(),
            'condition' => $article->getCondition(),
            'image' => $article->getImagePath()
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function read(int $id)
    {
        $sql = 'SELECT * FROM Articles WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $articleData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$articleData) {
            return null;
        }

        return $this->dataToObject($articleData);
    }

    public function update(object $article)
    {
        // Met à jour les informations d'un article dans la bdd
    }

    public function delete(int $id)
    {
        // Supprime un article dans la bdd
    }

    public function getLastsArticles(int $limit = 12)
    {
        $sql = 'SELECT *
                FROM Articles
                ORDER BY publish_date DESC
                LIMIT :limit';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $lastArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createArticleObjects($lastArticles);
    }

    public function getAll()
    {
        $articlesData = $this->fetchAllArticles();

        return $this->createArticleObjects($articlesData);
    }

    public function findByFilters(array $filters): array
{
    $sql = "SELECT * FROM Articles WHERE price <= :prix_max";
    $params = ['prix_max' => $filters['prix_max']];
    
    // Filtrer par catégories
    if (!empty($filters['categories'])) {
        $placeholders = [];
        foreach ($filters['categories'] as $index => $cat) {
            $key = 'cat_' . $index;
            $placeholders[] = ':' . $key;
            $params[$key] = $cat;
        }
        $sql .= " AND category IN (" . implode(',', $placeholders) . ")";
    }
    
    // Filtrer par tailles
    if (!empty($filters['tailles'])) {
        $placeholders = [];
        foreach ($filters['tailles'] as $index => $taille) {
            $key = 'taille_' . $index;
            $placeholders[] = ':' . $key;
            $params[$key] = $taille;
        }
        $sql .= " AND size IN (" . implode(',', $placeholders) . ")";
    }
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $this->createArticleObjects($articlesData);
}

public function getAllCategories(): array
{
    $sql = "SELECT DISTINCT category FROM Articles WHERE category IS NOT NULL ORDER BY category";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public function getAllSizes(): array
{
    $sql = "SELECT DISTINCT size FROM Articles WHERE size IS NOT NULL ORDER BY size";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

    private function fetchAllArticles()
    {
        $sql = 'SELECT * FROM Articles';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function createArticleObjects(array $articlesData)
    {
        $articleObjects = [];
        foreach ($articlesData as $article) {
            $articleObjects[] = $this->dataToObject($article);
        }
        return $articleObjects;
    }

    private function dataToObject(array $articleData)
    {
        return new Article(
            $articleData['id'],
            $articleData['seller_id'],
            $articleData['title'],
            $articleData['description'],
            $articleData['price'],
            $articleData['category'],
            $articleData['size'],
            $articleData['brand'],
            $articleData['condition'],
            $articleData['image']
        );
    }

}
