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
use Validators\UserRegistrationValidator;
use Validators\UserConnexionValidator;
use Services\UserService;
use Controllers\UserController;

session_start();

$database = new Database();

$userRepository = new UserRepository($database->getConnection());
$userRegistrationValidator = new UserRegistrationValidator();
$userConnexionValidator = new UserConnexionValidator();
$userService = new UserService($userRepository, $userRegistrationValidator, $userConnexionValidator);
$userController = new UserController($userService);

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
        default:
            exit();
    }
}

switch ($page) {
    case 'creer-compte':
        include_once 'src/views/front/creer-compte.php';
        break;
    case 'connexion':
        include_once 'src/views/front/connexion.php';
        break;
    case 'articles':
        include_once 'src/views/front/articles.php';
        break;
    case 'a-propos':
        include_once 'src/views/front/a-propos.php';
        break;
    case 'panier':
        include_once 'src/views/front/panier.php';
        break;
    case 'accueil':
    default:
        include_once 'src/views/front/accueil.php';
        break;
}
