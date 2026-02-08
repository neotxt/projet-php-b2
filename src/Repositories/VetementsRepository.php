<?php

namespace Repositories;

use PDO;
use PDOException;

class VetementsRepository implements Repository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les derniers articles (limit par défaut 12)
     *
     * @param int $limit
     * @return array
     */
    public function getDerniersArticles(int $limit = 12): array
    {
        try {
            $sql = "SELECT id, titre AS nom, image, prix
                    FROM Vetements
                    ORDER BY date_publication DESC
                    LIMIT :limit";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            // En dev, on peut logger ou afficher l'erreur; ici on retourne un tableau vide
            return [];
        }
    }

    /**
     * Récupère un article par son id
     *
     * @param int $id
     * @return array|null
     */
    public function read(int $id)
    {
        try {
            $sql = "SELECT id, titre AS nom, description, image, prix, categorie, taille, marque, etat, statut
                    FROM Vetements
                    WHERE id = :id
                    LIMIT 1";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row === false ? null : $row;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Récupère tous les vêtements
     *
     * @return array
     */
    public function getAll(): array
    {
        try {
            $sql = "SELECT id, titre AS nom, description, image, prix, categorie, taille, marque, etat, statut
                    FROM Vetements
                    ORDER BY date_publication DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    // Méthodes minimales pour respecter l'interface Repository
    public function create(object $vetement)
    {
        // TODO: implémenter si nécessaire (insertion préparée)
    }

    public function update(object $vetement)
    {
        // TODO: implémenter si nécessaire (update préparé)
    }

    public function delete(int $id)
    {
        // TODO: implémenter si nécessaire (delete préparé)
    }
}