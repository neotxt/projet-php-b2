<?php

namespace Validators;

use Exception;

class UserRegistrationValidator
{
    public function validateRegistration(array $userData): void
    {
        $this->validateRequiredFields($userData);
        $this->validateEmail($userData['email']);
        $this->validatePassword($userData['password'], $userData['confirmPassword']);
    }

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

    private function validateEmail(string $email): void
    {
        $cleanEmail = trim($email);

        if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse email est mal formée.");
        }
    }

    private function validatePassword(string $password, string $confirmPassword): void
    {
        $this->validatePasswordStrength($password);
        $this->validateSamePassword($password, $confirmPassword);
    }

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

    private function validateSamePassword(string $password, string $confirmPassword): void
    {
        if ($password !== $confirmPassword) {
            throw new Exception("Les mots de passes ne correspondent pas.");
        }
    }

}
