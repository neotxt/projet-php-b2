<?php

namespace Services;

use Repositories\UserRepository;
use Validators\UserRegistrationValidator;
use Validators\UserConnexionValidator;
use Models\User;

use Exception;

/**
 * Gère la logique métier des utilisateurs. (inscription, connexion)
 */
class UserService
{
    private UserRepository $userRepository;
    private UserRegistrationValidator $userRegistrationValidator;
    private UserConnexionValidator $userConnexionValidator;

    public function __construct(UserRepository $userRepository, UserRegistrationValidator $userRegistrationValidator, UserConnexionValidator $userConnexionValidator)
    {
        $this->userRepository = $userRepository;
        $this->userRegistrationValidator = $userRegistrationValidator;
        $this->userConnexionValidator = $userConnexionValidator;

    }

    /**
     * Traite l'inscription d'un nouvel utilisateur.
     * @param array $userData
     * @throws Exception
     * @return void
     */
    public function userRegister(array $userData): User
    {
        $userData = array_map('trim', $userData);

        $this->userRegistrationValidator->validateRegistration($userData);

        if ($this->userRepository->emailExists($userData['email'])) {
            throw new Exception("Cet email est déjà utilisé");
        }

        $password = $userData['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $user = new User(
            0,
            $userData['last_name'],
            $userData['first_name'],
            $userData['email'],
            $hashedPassword,
            false // Par défaut, un nouvel utilisateur n'est pas admin
        );



        $newId = $this->userRepository->create($user);

        if (!$newId) {
            throw new Exception("Votre compte n'a pas pu être créé, réessayez.");
        }

        $user->setId($newId);

        return $user;
    }

    /**
     * Vérifie les identifiants de connexion d'un utilisateur.
     * @param array $userData
     * @throws Exception
     * @return User
     */
    public function userConnexion(array $userData): User
    {
        $userData = array_map('trim', $userData);

        $this->userConnexionValidator->validateConnexion($userData);

        $user = $this->userRepository->readByEmail($userData['email']);


        if ($user && password_verify($userData['password'], $user->getPassword())) {
            return $user;
        } else {
            throw new Exception("Email ou mot de passe incorrect.");
        }
    }


    public function deleteUser(int $id): void
    {
        $this->userRepository->deleteUser($id);
    }
}
