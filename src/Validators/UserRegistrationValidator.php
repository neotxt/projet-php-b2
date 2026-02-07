<?php

namespace Validators;

use Exception;

/**
 * Valide les informations données lors de l'inscription d'un utilisateur.
 */
class UserRegistrationValidator
{
    /**
     * Centralise les différentes validations.
     * @param array $userData
     * @return void
     */
    public function validateRegistration(array $userData): void
    {
        $this->validateRequiredFields($userData);
        $this->validateEmail($userData['email']);
        $this->validatePassword($userData['password'], $userData['confirmPassword']);
    }

    /**
     * Vérifie que toutes les informations sont données.
     * @param array $userData
     * @throws Exception
     * @return void
     */
    private function validateRequiredFields(array $userData): void
    {
        if (
            empty($userData['lastName'] ?? '') ||
            empty($userData['firstName'] ?? '') ||
            empty($userData['email'] ?? '') ||
            empty($userData['password'] ?? '') ||
            empty($userData['confirmPassword'] ?? '')
        ) {
            throw new Exception("Tous les champs doivent être remplis");
        }
    }

    /**
     * Vérifie que l'email donné est dans le bon format.
     * @param string $email
     * @throws Exception
     * @return void
     */
    private function validateEmail(string $email): void
    {
        $cleanEmail = trim($email);

        if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse email est mal formée.");
        }
    }

    /**
     * Centralise les validations des mots de passe.
     * @param string $password
     * @param string $confirmPassword
     * @return void
     */
    private function validatePassword(string $password, string $confirmPassword): void
    {
        $this->validatePasswordStrength($password);
        $this->validateSamePassword($password, $confirmPassword);
    }

    /**
     * Vérifie si le mot de passe est assez compliqué
     * @param string $password
     * @throws Exception
     * @return void
     */
    private function validatePasswordStrength(string $password): void
    {
        if (
            strlen($password) < 12 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/\d/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            throw new Exception("Votre mot de passe est trop faible.");
        }
    }

    /**
     * Vérifie que le mot de passe de confirmation correspond au mot de passe donné.
     * @param string $password
     * @param string $confirmPassword
     * @throws Exception
     * @return void
     */
    private function validateSamePassword(string $password, string $confirmPassword): void
    {
        if ($password !== $confirmPassword) {
            throw new Exception("Les mots de passes ne correspondent pas.");
        }
    }

}
