<?php

declare(strict_types=1);

use app\controllers\AuthController;
use app\src\Application;
use app\controllers\HomeController;

require_once __DIR__ . '/../autoload.php';

$config = [
    'db' => [
        'dsn' => '',
        'user' => '',
        'password' => ''
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/login', [AuthController::class, 'index']);

$app->run();