<?php

declare(strict_types=1);

use app\controllers\AboutController;
use app\controllers\auth\ProfileController;
use app\controllers\auth\ProfileEditController;
use app\controllers\auth\PasswordController;
use app\controllers\AuthController;
use app\controllers\GenreController;
use app\controllers\MovieController;
use app\controllers\PlayMovieController;
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

/*
 * HOME
 */
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/about', [AboutController::class, 'index']);

/*
 * LOGIN
 */
$app->router->get('/login', [AuthController::class, 'index']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);


/*
 * REGISTER
 */
$app->router->get('/register', [RegisterController::class, 'index']);
$app->router->post('/register', [RegisterController::class, 'create']);


/*
 * USER PROFILE ROUTES
 */
$app->router->get('/profile', [ProfileController::class, 'index']);

$app->router->get('/profile/change-password', [PasswordController::class, 'index']);
$app->router->post('/profile/change-password', [PasswordController::class, 'update']);

$app->router->get('/profile/edit', [ProfileEditController::class, 'index']);
$app->router->post('/profile/edit', [ProfileEditController::class, 'update']);


/*
 * MOVIES
 */
$app->router->get('/movies', [MovieController::class, 'index']);
$app->router->get('/movie/:id', [PlayMovieController::class, 'show']);


/*
 * GENRES
 */
$app->router->get('/genre', [GenreController::class, 'index']);
$app->router->get('/genre/:id', [GenreController::class, 'show']);


/*
 * SEARCH
 */
$app->router->get('/search', [SearchFilterController::class, 'index']);
$app->router->get('/results', [SearchFilterController::class, 'show']);



// Run the application
$app->run();