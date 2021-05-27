<?php


namespace app\src;


abstract class Controller
{
    public array $middleware = [];

    public function render($view, $data = [])
    {
        return Application::$app->router->view($view, $data);
    }

    /**
     * @param array $middleware
     */
    public function setMiddleware(array $middleware): void
    {
        $this->middleware = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}