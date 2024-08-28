<?php

use Root\App\Controllers\UsersController;
use Root\App\DB;
use Root\App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$databaseFile = __DIR__ . '/../users.sqlite';

$PDO = DB::getInstance($databaseFile);

$router = new Router();

$router->register('/', function () {
    echo 'Hello world!';
});

$router->register('/users', [UsersController::class, 'index']);
$router->register('/users/create', [UsersController::class, 'create']);
$router->register('/users/store', [UsersController::class, 'store']);


$router->resolve($_SERVER['REQUEST_URI'], $PDO);
