<?php

declare(strict_types=1);

use app\controllers\auth\ProfileController;
use app\controllers\auth\ProfileEditController;
use app\controllers\auth\PasswordController;
use app\controllers\AuthController;
use app\controllers\GenreController;
use app\controllers\MovieController;
use app\controllers\RegisterController;
use app\controllers\SearchFilterController;
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

/*
 * AUTH ROUTES
 * Protected by AuthMiddleware
 */
$app->router->get('/profile', [ProfileController::class, 'index']);

$app->router->get('/profile/change-password', [PasswordController::class, 'index']);
$app->router->post('/profile/change-password', [PasswordController::class, 'update']);

$app->router->get('/profile/edit', [ProfileEditController::class, 'index']);
$app->router->post('/profile/edit', [ProfileEditController::class, 'update']);




$app->router->get('/movie', [MovieController::class, 'index']);
$app->router->get('/movie/:id', [MovieController::class, 'show']);

$app->router->get('/genre', [GenreController::class, 'index']);
$app->router->get('/genre/:id', [GenreController::class, 'show']);


$app->router->get('/search', [SearchFilterController::class, 'index']);
$app->router->get('/results', [SearchFilterController::class, 'result']);
$app->router->post('/results', [SearchFilterController::class, 'filter']);




$app->run();