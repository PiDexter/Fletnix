<?php

declare(strict_types=1);


use app\src\controllers\AboutController;
use app\src\controllers\auth\LoginController;
use app\src\controllers\auth\LogoutController;
use app\src\controllers\auth\PasswordController;
use app\src\controllers\auth\ProfileController;
use app\src\controllers\auth\ProfileEditController;
use app\src\controllers\auth\RegisterController;
use app\src\controllers\GenreController;
use app\src\controllers\HomeController;
use app\src\controllers\MovieController;
use app\src\controllers\PlayMovieController;
use app\src\controllers\SearchFilterController;
use app\src\core\Application;

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
$app->router->get('', [HomeController::class, 'index']);
$app->router->get('/about', [AboutController::class, 'index']);

/*
 * LOGIN
 */
$app->router->get('/login', [LoginController::class, 'index']);
$app->router->post('/login', [LoginController::class, 'login']);
$app->router->get('/logout', [LogoutController::class, 'logout']);


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