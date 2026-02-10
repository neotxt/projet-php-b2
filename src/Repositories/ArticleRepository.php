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
        $sql = "INSERT INTO Vetements (id_vendeur, titre, description, prix, categorie, taille, marque, etat, image)
                VALUES (:id_vendeur, :titre, :description, :prix, :categorie, :taille, :marque, :etat, :image)";

        $query = $this->db->prepare($sql);

        return $query->execute([
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
    }

    public function read(int $id)
    {

        $sql = 'SELECT * FROM Vetements WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $articleData = $query->fetch(PDO::FETCH_ASSOC);
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
