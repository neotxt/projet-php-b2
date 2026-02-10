<?php

namespace Services;

use Repositories\ArticleRepository;
use Exception;

class ArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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
}
