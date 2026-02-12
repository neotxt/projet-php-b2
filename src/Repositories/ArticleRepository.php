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
        $sql = "INSERT INTO Articles (id_vendeur, titre, description, prix, categorie, taille, marque, etat, image)
                VALUES (:id_vendeur, :titre, :description, :prix, :categorie, :taille, :marque, :etat, :image)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id_vendeur' => $article->getIdSeller(),
            'titre' => $article->getTitle(),
            'description' => $article->getDescription(),
            'prix' => $article->getPrice(),
            'categorie' => $article->getCategory(),
            'taille' => $article->getSize(),
            'marque' => $article->getMarque(),
            'etat' => $article->getState(),
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

        return $this->dataToArticle($articleData);
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
                ORDER BY date_publication DESC
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
            $articleObjects[] = $this->dataToArticle($article);
        }
        return $articleObjects;
    }

    private function dataToArticle(array $articleData)
    {
        return new Article(
            $articleData['id'],
            $articleData['id_vendeur'],
            $articleData['titre'],
            $articleData['description'],
            $articleData['prix'],
            $articleData['categorie'],
            $articleData['taille'],
            $articleData['marque'],
            $articleData['etat'],
            $articleData['image']
        );
    }

}
