<?php

declare(strict_types=1);

use app\controllers\AuthController;
use app\controllers\GenreController;
use app\controllers\MovieController;
use app\controllers\ProfileController;
use app\controllers\RegisterController;
use app\src\Application;
use app\controllers\HomeController;

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

$app->router->get('/profile', [ProfileController::class, 'index']);
$app->router->post('/profile', [ProfileController::class, 'updateDetails']);
$app->router->post('/profile', [ProfileController::class, 'updatePassword']);


$app->router->get('/movie', [MovieController::class, 'index']);
$app->router->get('/movie/:id', [MovieController::class, 'show']);

$app->router->get('/genre', [GenreController::class, 'index']);
$app->router->get('/genre/:id', [GenreController::class, 'show']);




$app->run();