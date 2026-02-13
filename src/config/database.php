<?php

namespace Config;

use PDO;
use PDOException;

use Utils\Logger;

class Database
{
    private $host = 'localhost';
    private $dbname = 'projet_php_b2';
    private $user = 'root';
    private $pass = '';
    private ?PDO $pdo = null;

    public function getConnection(): PDO
    {
        if ($this->pdo !== null) {
            return $this->pdo;
        }

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Logger::info("Connexion à la base de donnée réussi");
        } catch (PDOException $e) {
            Logger::error("Impossible de se connecter à la base de données", ['exception' => $e->getMessage()]);
            die('Erreur de connexion...');
        }
        return $this->pdo;
    }

}

