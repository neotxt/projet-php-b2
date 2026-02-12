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

    public function displayArticles()
    {
        try {
            $articles = $this->articleService->getAllArticles();
        } catch (Exception $e) {
            $articles = [];
        }
        require_once 'src/views/front/articles.php';
    }

    public function displayDetailProduit()
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

    public function deleteArticle()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['error'] = "ID article manquant";
            header('Location: index.php?page=mes-articles');
            exit();
        }

        $id = $_GET['id'];
        try {
            $this->articleService->deleteArticle($id);
            $_SESSION['success'] = "Article supprimé avec succès";
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur lors de la suppression : " . $e->getMessage();
        }
        header('Location: index.php?page=mes-articles');
        exit();
    }
}
