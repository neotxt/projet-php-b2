<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $dbname = 'projet_php_b2';
    private $user = 'root';
    private $pass = '';
    private $pdo;

    public function getConnection(): PDO
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données: ' . $e->getMessage());
        }
        return $this->pdo;
    }

}

