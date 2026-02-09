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
}