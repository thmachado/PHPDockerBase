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
        } catch (\PDOException $e) {
            throw new PDOException("Error Processing Request {$e->getMessage()}");
        }
    }

    public static function getInstance(string $databaseFile): static
    {
        if (self::$instance === null) {
            return new self($databaseFile);
        }

        return self::$instance;
    }
}
