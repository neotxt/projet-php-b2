<?php

namespace Controllers;

use Services\ArticleService;
use Exception;
use Utils\Logger;

class ArticleController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function displayArticles()
    
    {
    // Initialiser les variables par défaut
    $articles = [];
    $categories = [];
    $tailles = [];
    
    try {
        // Récupérer toutes les catégories et tailles disponibles
        $categories = $this->articleService->getAllCategories();
        $tailles = $this->articleService->getAllSizes();
        
        // Récupérer les filtres depuis l'URL
        $filters = [
            'categories' => $_GET['categorie'] ?? [],
            'tailles' => $_GET['taille'] ?? [],
            'prix_max' => $_GET['prix_max'] ?? 200
        ];
        
        // Passer les filtres au service
        $articles = $this->articleService->getFilteredArticles($filters);
        
    } catch (Exception $e) {
        Logger::warn("Erreur lors du chargement des articles", ['error' => $e->getMessage()]);
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
    public function displayVente()
    {
        if (empty($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour vendre un article.";
            header('Location: index.php?page=connexion');
            exit();
        }
        require_once 'src/views/front/vente.php';
    }

    public function submitVendre()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=vente');
            exit();
        }
        try {
            $newId = $this->articleService->createArticle($_POST, $_FILES['image']);

            $_SESSION['success'] = "Votre article est en ligne !";
            header('Location: index.php?page=details-produit&id=' . $newId);
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: index.php?page=vente');
            exit();
        }
    }


    public function deleteArticle()
    {
        // Pour suppression admin ou user
        $articleId = $_GET['id'] ?? $_POST['id'] ?? null;
        if (!$articleId) {
            $_SESSION['error'] = "ID article manquant";
            header('Location: index.php?page=mes-articles');
            exit();
        }

        // Si admin, il peut tout supprimer. Sinon, vérifier que l'article appartient à l'utilisateur
        $isAdmin = !empty($_SESSION['is_admin']) && $_SESSION['is_admin'];
        if (!$isAdmin) {
            // Vérifier que l'article appartient à l'utilisateur
            $article = $this->articleService->getArticleById($articleId);
            if (!$article || $article->getSellerId() != $_SESSION['user_id']) {
                $_SESSION['error'] = "Vous n'avez pas le droit de supprimer cet article.";
                header('Location: index.php?page=mes-articles');
                exit();
            }
        }

        try {
            $this->articleService->deleteArticle($articleId);
            $_SESSION['success'] = "Article supprimé avec succès";
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur lors de la suppression : " . $e->getMessage();
        }
        // Redirection différente si admin ou user
        if ($isAdmin) {
            header('Location: index.php?page=articles');
        } else {
            header('Location: index.php?page=mes-articles');
        }
        exit();
    }

        public function displayAdmin()
        {
            if (empty($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
                $_SESSION['error'] = "Accès réservé à l'administrateur.";
                header('Location: index.php?page=accueil');
                exit();
            }
            $articles = $this->articleService->getAllArticles();

            // Récupérer tous les utilisateurs pour la gestion admin
            $userRepository = new \Repositories\UserRepository((new \Config\Database())->getConnection());
            $users = $userRepository->getAll();

            require_once 'src/views/front/admin.php';
        }
}
