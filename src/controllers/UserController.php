<?php

namespace Controllers;

use Services\UserService;
use Exception;

/**
 * Contrôleur gérant les actions liés aux utilisateurs.
 * Il s'occuppe de la réception des formulaires, les traite grâce au Service
 * Et gère les redirections.
 */
class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Traite la soumission du formulaire d'inscription
     * 
     * Vérifie la méthode POST, appelle le service d'inscription
     * Succès: Redirige vers la page de connexion.
     * Refus: Donne l'erreur.
     * @return never
     */
    public function createUser(): void
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

    /**
     * Traite la soumission au formulaire de connexion.
     *
     * Appelle le service de connexion pour vérifier les identifiants.
     * Succès: Remplit la SESSION et redirige vers l'écran d'accueil.
     * Refus: Donne l'erreur.
     * @return void
     */
    public function connexionUser(): void
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

    /**
     * Déconnecte l'utilisateur.
     * Vide la session, supprime les cookies et redirigé vers la page de connexion.
     * @return never
     */
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
