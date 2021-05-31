<?php


namespace app\middleware;


use app\src\Application;
use app\src\ForbiddenException;
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