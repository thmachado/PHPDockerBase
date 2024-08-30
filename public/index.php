<?php

use Root\App\Controllers\UsersController;
use Root\App\DB;
use Root\App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$databaseFile = __DIR__ . '/../users.sqlite';

$PDO = DB::getInstance($databaseFile);

session_start();

$router = new Router();

$router->get('/', function () {
    echo 'Hello world!';
});

$router->get('/users', [UsersController::class, 'index']);
$router->get('/users/create', [UsersController::class, 'create']);
$router->get('/users/edit', [UsersController::class, 'edit']);
$router->get('/users/delete', [UsersController::class, 'delete']);
$router->post('/users/store', [UsersController::class, 'store']);
$router->post('/users/update', [UsersController::class, 'update']);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $PDO);
