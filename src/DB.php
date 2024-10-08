<?php

namespace Root\App;

use PDO;
use PDOException;

class DB
{
    public static ?PDO $instance = null;

    public function __construct(string $databaseFile)
    {
        try {
            self::$instance = new PDO("sqlite:{$databaseFile}");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$instance->exec('CREATE TABLE IF NOT EXISTS users (
                firstname TEXT,
                lastname TEXT,
                email TEXT,
                password TEXT,
                deleted INTEGER,
                suspended INTEGER,
                status INTEGER,
                role INTEGER,
                timecreated TEXT
            )');

            self::$instance->exec('CREATE TABLE IF NOT EXISTS products (
                name TEXT,
                description TEXT,
                category TEXT,
                quantity INTEGER,
                price INTEGER,
                timecreated TEXT
            )');
        } catch (PDOException $e) {
            throw new PDOException("Error Processing Request {$e->getMessage()}");
        }
    }

    public static function getInstance(string $databaseFile): PDO
    {
        if (self::$instance === null) {
            new self($databaseFile);
        }

        return self::$instance;
    }
}
