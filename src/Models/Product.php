<?php

namespace Root\App\Models;

class Product
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT rowid, name, description, category, quantity, price FROM products ORDER BY name ASC");
        if ($stmt->execute() === false) {
            return [];
        }

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function create(string $name, string $description, string $category, int $quantity, int $price): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, category, quantity, price, timecreated) 
                                    VALUES (:name, :description, :category, :quantity, :price, datetime('now'))");
        $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
        $stmt->bindValue(':category', $category, \PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, \PDO::PARAM_INT);

        if ($stmt->execute() === false) {
            return false;
        }

        return true;
    }
}
