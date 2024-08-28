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
                id INTEGER PRIMARY KEY, 
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
        } catch (\PDOException $e) {
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
