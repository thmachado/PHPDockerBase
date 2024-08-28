<?php

namespace Root\App\Models;

class User
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT firstname, lastname, email FROM users ORDER BY firstname, lastname ASC");
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function create(string $firstname, string $lastname, string $email, string $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, deleted, suspended, status, role, timecreated) 
                                    VALUES (:firstname, :lastname, :email, :password, 0, 0, 'active', 'user', datetime('now'))");
        $stmt->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, \PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->pdo->lastInsertId();
        }

        return false;
    }
}
