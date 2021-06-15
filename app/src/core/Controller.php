<?php


namespace app\src\core;


abstract class Controller
{
    public array $middleware = [];

    /**
     * @param string $view
     * @param array $data
     * @return bool|array|string
     */
    public function render(string $view, array $data = []): bool|array|string
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