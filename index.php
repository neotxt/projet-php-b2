<?php

// Autoloader des classes
spl_autoload_register(function ($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $file = __DIR__ . '/src/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("Erreur : Impossible de charger la classe $class (Fichier attendu : $file)");
    }
});

use Config\Database;

use Repositories\UserRepository;
use Repositories\ArticleRepository;

use Validators\UserRegistrationValidator;
use Validators\UserConnexionValidator;
use Validators\ArticleImageValidator;

use Services\UserService;
use Services\ArticleService;

use Controllers\UserController;
use Controllers\ArticleController;
use Controllers\PageController;
use Controllers\CartController;

session_start();

$database = new Database();

$userRepository = new UserRepository($database->getConnection());
$userRegistrationValidator = new UserRegistrationValidator();
$userConnexionValidator = new UserConnexionValidator();
$userService = new UserService($userRepository, $userRegistrationValidator, $userConnexionValidator);
$userController = new UserController($userService);

$articleRepository = new ArticleRepository($database->getConnection());
$articleImageValidator = new ArticleImageValidator();
$articleService = new ArticleService($articleRepository, $articleImageValidator);
$articleController = new ArticleController($articleService);

$pageController = new PageController($articleService, $userService);
$cartController = new CartController($articleService);

$page = $_GET['page'] ?? 'accueil';
$action = $_GET['action'] ?? '';

if ($action) {
    switch ($action) {
        case 'submit_register':
            $userController->createUser();
            exit();
        case 'submit_connexion':
            $userController->connexionUser();
            exit();
        case 'logout':
            $userController->logoutUser();
            exit();
        case 'submit_vendre':
            $articleController->submitVendre();
            exit();
        case 'supprimer_article':
            $articleController->deleteArticle(); // On demande au Controller de supprimer
            exit();
        case 'ajouter_au_panier':
            $cartController->ajouterAuPanier();
            exit();
        case 'supprimer_panier':
            $cartController->supprimerDuPanier();
            exit();
        default:
            exit();
    }
}

switch ($page) {
    case 'details-produit':
        $articleController->displayDetailProduit();
        break;
    case 'articles':
        $articleController->displayArticles();
        break;
    case 'creer-compte':
        $userController->displayCreerCompte();
        break;
    case 'connexion':
        $userController->displayConnexion();
        break;
    case 'panier':
        $cartController->afficherPanier();
        break;
    case 'paiement':
        include_once 'src/views/front/paiement.php';
        break;
    case 'a-propos':
        $pageController->displayAPropos();
        break;
    case 'vente':
        $articleController->displayVente();
        break;
    case 'mes-articles':
        include_once 'src/views/front/mes-articles.php';
        break;
    case 'accueil':
    default:
        $pageController->displayAccueil();
        break;

}
