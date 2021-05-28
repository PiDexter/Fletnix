<?php


namespace app\src;


use app\middleware\Middleware;

abstract class Controller
{
    public array $middleware = [];

    public function render($view, $data = [])
    {
        return Application::$app->router->view($view, $data);
    }

    /**
     * @param Middleware $middleware
     */
    public function setMiddleware(Middleware $middleware): void
    {
        $this->middleware[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}