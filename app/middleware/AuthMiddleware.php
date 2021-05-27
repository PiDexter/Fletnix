<?php


namespace app\middleware;


use app\src\Application;
use app\src\ForbiddenException;

class AuthMiddleware extends Middleware
{

    /**
     * @throws \Exception
     */
    public function handle()
    {

        if (Application::$app->session->get('user')) {
            http_response_code(403);
            throw new ForbiddenException();
        }

    }
}