<?php

namespace Validators;

use Exception;

class UserConnexionValidator
{
    public function validateConnexion(array $userData)
    {
        $this->validateRequiredFields($userData);
    }

    private function validateRequiredFields(array $userData): void
    {
        if (
            empty($userData['email'] ?? '') ||
            empty($userData['password'] ?? '')
        ) {
            throw new Exception("Tous les champs doivent être remplis");
        }
    }

}
