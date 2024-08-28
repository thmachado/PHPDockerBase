<?php

use Root\App\DB;

require_once __DIR__ . '/../vendor/autoload.php';

$databaseFile = __DIR__ . '/../users.sqlite';

$PDO = DB::getInstance($databaseFile);
