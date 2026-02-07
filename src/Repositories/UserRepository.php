<?php

namespace Repositories;

use PDO;

/*
 * Classe implémentant Repository, permettant de mettre à jour les utilisateurs dans la BDD
 */
class UserRepository implements Repository
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }


    // Créer un nouveau user dans la bdd
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

    public function readByEmail(string $email)
    {
        $sql = 'SELECT id, email, password FROM Users WHERE email = :email';
        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getEmail(string $email): bool
    {
        $sql = 'SELECT id FROM Users WHERE email = :email';
        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);

        return (bool) $query->fetch();
    }
}
