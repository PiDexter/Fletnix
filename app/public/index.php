<?php

declare(strict_types=1);

use app\controllers\AuthController;
use app\controllers\MovieController;
use app\controllers\RegisterController;
use app\src\Application;
use app\controllers\HomeController;
use app\src\Route;

require_once __DIR__ . '/../autoload.php';

$config = [
    'db' => [
        'dsn' => 'mysql:dbname=fletnix;host=mysql',
        'user' => 'testuser',
        'password' => 'secret'
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/login', [AuthController::class, 'index']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/register', [RegisterController::class, 'index']);
$app->router->post('/register', [RegisterController::class, 'create']);

$app->router->get('/movie', [MovieController::class, 'index']);
$app->router->get('/movie/:id', [MovieController::class, 'show']);



$app->run();