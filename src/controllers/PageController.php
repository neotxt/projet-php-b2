<?php

namespace Controllers;

use Services\ArticleService;
use Services\UserService;

use Exception;

class PageController
{
    private ArticleService $articleService;
    private UserService $userService;

    public function __construct(ArticleService $articleService, UserService $userService)
    {
        $this->articleService = $articleService;
        $this->userService = $userService;
    }

    public function displayAccueil()
    {
        try {
            $articles = $this->articleService->getLastsArticles();
        } catch (Exception $e) {
            $articles = [];
        }

        require_once 'src/views/front/accueil.php';
    }

    public function displayAPropos()
    {
        require_once 'src/views/front/a-propos.php';
    }

    public function displayPaiement()
    {
        if (empty($_SESSION['user_id'])) {
            $_SESSION['error'] = "Veuillez vous connecter pour valider votre commande.";
            header('Location: index.php?page=connexion');
            exit();
        }

        require_once 'src/views/front/paiement.php';
    }
}
