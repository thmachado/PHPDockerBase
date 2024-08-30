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
        $stmt = $this->pdo->prepare("SELECT rowid, firstname, lastname, email FROM users ORDER BY firstname, lastname ASC");
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function find(int $userid)
    {
        $stmt = $this->pdo->prepare("SELECT rowid, firstname, lastname, email FROM users WHERE rowid = :userid");
        $stmt->bindValue(':userid', $userid, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(\PDO::FETCH_OBJ);
        }

        return false;
    }

    public function delete(int $userid): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE rowid = :userid");
        $stmt->bindValue(':userid', $userid, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }

        return false;
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
            return true;
        }

        return false;
    }

    public function update(int $userid, string $firstname, string $lastname)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname WHERE rowid = :userid");
        $stmt->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $stmt->bindValue(':userid', $userid, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
