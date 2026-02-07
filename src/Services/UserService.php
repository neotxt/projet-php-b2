<?php

namespace Services;

use Repositories\UserRepository;
use Validators\UserRegistrationValidator;
use Validators\UserConnexionValidator;
use Models\User;

use Exception;

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

    public function userRegister(array $userData): void
    {
        $userData = array_map('trim', $userData);

        $this->userRegistrationValidator->validateRegistration($userData);

        if ($this->userRepository->getEmail($userData['email'])) {
            throw new Exception("Cet email est déjà utilisé");
        }

        $password = $userData['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $user = new User(
            $userData['lastName'],
            $userData['firstName'],
            $userData['email'],
            $hashedPassword
        );

        $creation = $this->userRepository->create($user);

        if (!$creation) {
            throw new Exception("Votre compte n'a pas pu être créé, réessayez.");
        }
    }

    public function userConnexion(array $userData)
    {
        $userData = array_map('trim', $userData);

        $this->userConnexionValidator->validateConnexion($userData);

        $user = $this->userRepository->readByEmail($userData['email']);

        if ($user && password_verify($userData['password'], $user['password'])) {
            return $user;
        } else {
            throw new Exception("Email ou mot de passe incorrect.");
        }
    }
}
