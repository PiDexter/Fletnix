<?php

declare(strict_types=1);

use app\src\Application;

require_once __DIR__ . '/../autoload.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', function () {
    return "hello";
});

$app->router->get('/contact', 'index');

$app->run();