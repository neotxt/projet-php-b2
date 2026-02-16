<?php

namespace Services;

use Repositories\ArticleRepository;
use Validators\ArticleImageValidator;
use Models\Article;

use Exception;

class ArticleService
{
    private ArticleRepository $articleRepository;
    private ArticleImageValidator $articleImageValidator;

    public function __construct(ArticleRepository $articleRepository, ArticleImageValidator $articleImageValidator)
    {
        $this->articleRepository = $articleRepository;
        $this->articleImageValidator = $articleImageValidator;
    }

    public function getAllArticles()
    {
        $articles = $this->articleRepository->getAll();

        if (!$articles) {
            throw new Exception("Aucun article n'a été trouvé.");
        }
        return $articles;
    }

    public function getArticleById(int $id)
    {
        $article = $this->articleRepository->read($id);

        if (!$article) {
            throw new Exception("L'article n'a pas été trouvé.");
        }
        return $article;
    }

    public function getLastsArticles()
    {
        $lastsArticles = $this->articleRepository->getLastsArticles();

        if (!$lastsArticles) {
            throw new Exception("Aucun article n'a été trouvé");
        }
        return $lastsArticles;
    }

    public function createArticle(array $articleData, array $fileData)
    {
        $this->articleImageValidator->validateImage($fileData);

        $imagePath = $this->uploadImage($fileData);

        $article = new Article(
            id: 0,
            idSeller: $_SESSION['user_id'],
            title: $articleData['title'],
            description: $articleData['description'],
            price: $articleData['price'],
            category: $articleData['category'],
            size: $articleData['size'],
            brand: $articleData['brand'] ?? 'Inconnu',
            condition: $articleData['condition'],
            imagePath: $imagePath
        );

        $newId = $this->articleRepository->create($article);

        if (!$newId) {
            throw new Exception("L'article n'a pas pu être créé.");
        }

        $article->setId($newId);

        return $newId;
    }

    private function uploadImage(array $fileData)
    {
        $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);

        //Créé un nom unique pour éviter les doublons
        $fileName = uniqid('img_') . '.' . $extension;

        $targetDir = 'src/public/articles/';


        $targetPath = $targetDir . $fileName;

        if (!move_uploaded_file($fileData['tmp_name'], $targetPath)) {
            throw new Exception("Le déplacement du fichier a échoué.");
        }

        return $targetPath;
    }

    public function deleteArticle(int $id) 
    {
        $this->articleRepository->delete($id);
    }
}
