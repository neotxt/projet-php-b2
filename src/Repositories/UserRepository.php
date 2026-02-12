<?php

namespace Repositories;

use PDO;

/**
 * Gère les requêtes SQL avec la table "users" de la base de données.
 * @implements Repository
 */
class UserRepository implements Repository {
    /**
     * Récupère tous les utilisateurs depuis la base de données
     * @return array Liste des utilisateurs
     */
    public function getAll()
    {
        $sql = 'SELECT * FROM Users';
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

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
        $sql = "INSERT INTO users (last_name,first_name, email, password)
                VALUES (:last_name, :first_name, :email, :password)";

        $query = $this->db->prepare($sql);

        return $query->execute([
            'last_name' => $user->getLastName(),
            'first_name' => $user->getFirstName(),
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
