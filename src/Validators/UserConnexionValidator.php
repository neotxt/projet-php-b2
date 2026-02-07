<?php

namespace Validators;

use Exception;

/**
 * Valide les informations données lors de la connexion d'un utilisateur
 */
class UserConnexionValidator
{
    /**
     * Centralise toutes les validations.
     * @param array $userData
     * @return void
     */
    public function validateConnexion(array $userData)
    {
        $this->validateRequiredFields($userData);
    }

    /**
     * Vérifie que toutes les informations sont donnés.
     * @param array $userData
     * @throws Exception
     * @return void
     */
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
