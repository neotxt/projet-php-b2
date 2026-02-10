<?php

namespace Controllers;

use Services\ArticleService;

use Exception;

class ArticleController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function listAllArticles()
    {
        try {
            $articles = $this->articleService->getAllArticles();
        } catch (Exception $e) {
            $articles = [];
        }
        require_once 'src/views/front/articles.php';
    }

    public function viewArticleDetails()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: index.php?page=articles');
            exit();
        }

        $id = $_GET['id'];
        try {
            $article = $this->articleService->getArticleById($id);
            require_once 'src/views/front/details-produit.php';
        } catch (Exception $e) {
            header('Location: index.php?page=articles');
            exit();
        }
    }
}
