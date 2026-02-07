<?php

namespace Controllers;

use Services\UserService;
use Exception;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Ouais ça créé un utilisateur
     * @return never
     */
    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=creer-compte');
            exit();
        }

        try {
            $this->userService->userRegister($_POST);
            $_SESSION['register_success'] = "Compte créé avec succès. Connectez-vous.";
            header('Location: index.php?page=connexion');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: index.php?page=creer-compte');
            exit();
        }
    }

    public function connexionUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=connexion');
            exit();
        }

        try {
            $user = $this->userService->userConnexion($_POST);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            header('Location: index.php?page=accueil');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: index.php?page=connexion');
            exit();
        }
    }

    public function logoutUser()
    {
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
}
