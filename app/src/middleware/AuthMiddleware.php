<?php


namespace app\src\middleware;


use app\src\core\Application;
use app\src\core\Middleware;
use app\src\exceptions\ForbiddenException;
use Exception;

class AuthMiddleware extends Middleware
{

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        if (!Application::$app->session->get('user')) {
            throw new ForbiddenException();
        }
    }
}