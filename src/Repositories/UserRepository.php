<?php

namespace Repositories;

use PDO;

/**
 * Gère les requêtes SQL avec la table "users" de la base de données.
 * @implements Repository
 */
class UserRepository implements Repository
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }


    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * @param object $user
     * @return bool
     */
    public function create(object $user): bool
    {
        $sql = "INSERT INTO users (nom, prenom, email, password)
                VALUES (:nom, :prenom, :email, :password)";

        $query = $this->db->prepare($sql);

        return $query->execute([
            'nom' => $user->getLastName(),
            'prenom' => $user->getFirstName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }

    public function read(int $id)
    {
        // Lis les informations d'un user dans la bdd
    }

    public function update(object $user)
    {
        // Met à jour les informations d'un user dans la bdd
    }

    public function delete(int $id)
    {
        // Supprime un utilisateur dans la bdd
    }

    /**
     * Cherche un utilisateur par rapport à son adresse mail.
     * @param string $email
     */
    public function readByEmail(string $email)
    {
        $sql = 'SELECT id, email, password FROM Users WHERE email = :email';
        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cherche si l'adresse email existe.
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        $sql = 'SELECT id FROM Users WHERE email = :email';
        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);

        return (bool) $query->fetch();
    }
}
