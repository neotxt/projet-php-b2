<?php

namespace Controllers;

use Services\UserService;
use Models\User;

use Exception;
use Utils\Logger;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=creer-compte');
            exit();
        }

        try {
            $newUser = $this->userService->userRegister($_POST);

            $_SESSION['register_success'] = "Compte créé avec succès. Connectez-vous.";

            Logger::info("Nouveau compte créé", [
                'name' => $newUser->getName(),
                'email' => $newUser->getEmail()
            ]);

            header('Location: index.php?page=connexion');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();

            Logger::error("Echec d'inscription", [
                'email' => $_POST['email'] ?? 'inconnu',
                'error' => $e->getMessage()
            ]);

            header('Location: index.php?page=creer-compte');
            exit();
        }
    }

    public function connexionUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=connexion');
            exit();
        }

        try {
            $user = $this->userService->userConnexion($_POST);

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_email'] = $user->getEmail();

            Logger::info("Connexion réussie", [
                'id' => $user->getId(),
                'email' => $user->getEmail()
            ]);

            header('Location: index.php?page=accueil');
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();

            Logger::warn("Echec de connexion", [
                'email_tente' => $_POST['email'] ?? '',
                'raison' => $e->getMessage()
            ]);

            header('Location: index.php?page=connexion');
            exit();
        }
    }

    public function logoutUser()
    {
        Logger::info("Déconnexion utilisateur", [
            'id' => $_SESSION['user_id'] ?? '?',
            'email' => $_SESSION['user_email'] ?? '?'
        ]);

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        header('Location: index.php?page=connexion');
        exit();
    }

    public function displayConnexion()
    {
        require_once 'src/views/front/connexion.php';
    }

    public function displayCreerCompte()
    {
        require_once 'src/views/front/creer-compte.php';
    }
}
