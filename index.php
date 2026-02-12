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

use Services\UserService;
use Services\ArticleService;

use Controllers\UserController;
use Controllers\ArticleController;
use Controllers\PageController;

session_start();

$database = new Database();

$userRepository = new UserRepository($database->getConnection());
$userRegistrationValidator = new UserRegistrationValidator();
$userConnexionValidator = new UserConnexionValidator();
$userService = new UserService($userRepository, $userRegistrationValidator, $userConnexionValidator);
$userController = new UserController($userService);

$articleRepository = new ArticleRepository($database->getConnection());
$articleService = new ArticleService($articleRepository);
$articleController = new ArticleController($articleService);

$pageController = new PageController($articleService, $userService);

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
        default:
            exit();
        case 'supprimer_article':
            $articleController->deleteArticle(); // On demande au Controller de supprimer
            exit();
    }
}

switch ($page) {
    case 'details-produit':
        $articleController->viewArticleDetails();
        break;
    case 'articles':
        $articleController->listAllArticles();
        break;
    case 'creer-compte':
        $userController->displayCreerCompte();
        break;
    case 'connexion':
        $userController->displayConnexion();
        break;
    case 'panier':
        $pageController->displayPanier();
        break;
    case 'a-propos':
        $pageController->displayAPropos();
        break;
    case 'vente':
        include_once 'src/views/front/vente.php';
        break;
    case 'mes-articles':
        include_once 'src/views/front/mes-articles.php';
        break;
    case 'accueil':
    default:
        $pageController->displayAccueil();
        break;
    
}
