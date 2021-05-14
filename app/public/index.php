<?php

declare(strict_types=1);

use app\controllers\AuthController;
use app\src\Application;
use app\controllers\HomeController;

require_once __DIR__ . '/../autoload.php';

$app = new Application(dirname(__DIR__));

//$app->router->get('/', function () {
//    return "hello";
//});
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/login', [AuthController::class, 'index']);


//$app->router->get('/contact', 'index');

$app->run();