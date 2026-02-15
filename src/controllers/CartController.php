<?php

namespace Controllers;

use Services\ArticleService;
use Exception;

class CartController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Ajoute un article au panier (stocké en session).
     * Si l'article existe déjà, il n'est ajouté qu'une fois .
     */
    public function ajouterAuPanier()
    {
        // Vérifie la présence de l'ID article dans l'URL
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: index.php?page=articles');
            exit();
        }
        $id = (int)$_GET['id'];
        try {
            // Récupère l'article depuis la base via le service
            $article = $this->articleService->getArticleById($id);
            // Initialise le panier si besoin
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }
            // Ajoute l'article au panier (clé = id article)
            $_SESSION['panier'][$id] = $article;
            $_SESSION['success'] = "Article ajouté au panier !";
        } catch (Exception $e) {
            $_SESSION['error'] = "Impossible d'ajouter l'article au panier.";
        }
        // Redirige vers la page panier
        header('Location: index.php?page=panier');
        exit();
    }

    /**
     * Supprime un article du panier (via son ID).
     */
    public function supprimerDuPanier()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: index.php?page=panier');
            exit();
        }
        $id = (int)$_GET['id'];
        if (isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
            $_SESSION['success'] = "Article supprimé du panier.";
        }
        header('Location: index.php?page=panier');
        exit();
    }

    /**
     * Affiche la page panier avec les articles stockés en session.
     */
    public function afficherPanier()
    {
        $articlesPanier = [];
        if (!empty($_SESSION['panier'])) {
            $articlesPanier = $_SESSION['panier'];
        }
        require_once 'src/views/front/panier.php';
    }
}
