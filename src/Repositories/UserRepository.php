<?php

namespace Repositories;

use Models\User;
use PDO;

/**
 * Gère les requêtes SQL avec la table "Users" de la base de données.
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
     * Récupère tous les utilisateurs depuis la base de données
     * @return User[] Liste d'objets User
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM Users';
        $stmt = $this->db->query($sql);
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($usersData as $userData) {
            $users[] = $this->dataToObject($userData);
        }
        return $users;
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * @param User $user (On type précisément l'objet)
     * @return int L'ID du nouvel utilisateur
     */
    public function create(object $user): int
    {
        $sql = "INSERT INTO Users (last_name, first_name, email, password, is_admin)
                VALUES (:last_name, :first_name, :email, :password, :is_admin)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'last_name' => $user->getLastName(),
            'first_name' => $user->getFirstName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'is_admin' => $user->isAdmin() ? 1 : 0
        ]);

        // On retourne l'ID créé pour pouvoir connecter l'utilisateur tout de suite après
        return (int) $this->db->lastInsertId();
    }

    public function read(int $id)
    {
        $sql = 'SELECT * FROM Users WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        return $this->dataToObject($userData);
    }

    public function update(object $user)
    {
        // À implémenter si besoin
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM Users WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    /**
     * Cherche un utilisateur par rapport à son adresse mail.
     * @param string $email
     * @return User|null
     */
    public function readByEmail(string $email)
    {
        $sql = 'SELECT * FROM Users WHERE email = :email';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        return $this->dataToObject($userData);
    }

    /**
     * Cherche si l'adresse email existe.
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        $sql = 'SELECT id FROM Users WHERE email = :email';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return (bool) $stmt->fetch();
    }

    /**
     * Transforme un tableau de données BDD en Objet User
     * @param array $userData
     * @return User
     */
    private function dataToObject(array $userData): User
    {
        return new User(
            $userData['id'],
            $userData['last_name'],
            $userData['first_name'],
            $userData['email'],
            $userData['password'],
            isset($userData['is_admin']) ? (bool)$userData['is_admin'] : false
        );
    }
     
    public function deleteUser(int $id): void
    {
        $sql = 'DELETE FROM Users WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}