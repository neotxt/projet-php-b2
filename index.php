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
use Repositories\OrderRepository;

use Validators\UserRegistrationValidator;
use Validators\UserConnexionValidator;
use Validators\ArticleImageValidator;

use Services\UserService;
use Services\ArticleService;
use Services\OrderService;

use Controllers\UserController;
use Controllers\ArticleController;
use Controllers\PageController;
use Controllers\CartController;
use Controllers\OrderController;

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

$orderRepository = new OrderRepository($database->getConnection());
$orderService = new OrderService($orderRepository, $articleRepository);
$orderController = new OrderController($orderService, $articleService);

$cartController = new CartController($articleService);

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
        case 'submit_vendre':
            $articleController->submitVendre();
            exit();
        case 'supprimer_article':
            $articleController->deleteArticle();
            exit();
        case 'supprimer_user':
            $userController->deleteUser();
            exit();
        case 'ajouter_au_panier':
            $cartController->ajouterAuPanier();
            exit();
        case 'supprimer_panier':
            $cartController->supprimerDuPanier();
            exit();
        case 'confirmation_commande':
            $orderController->createOrder();
            break;
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
        $pageController->displayPaiement();
        break;
    case 'a-propos':
        $pageController->displayAPropos();
        break;
    case 'vente':
        $articleController->displayVente();
        break;
    case 'mes-articles':
        $articleController->displayMesArticles();
        break;
    case 'admin':
        $articleController->displayAdmin();
        break;
    case 'accueil':
    default:
        $pageController->displayAccueil();
        break;

}
