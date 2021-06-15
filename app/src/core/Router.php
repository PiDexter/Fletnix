<?php


namespace app\src\core;


use app\src\exceptions\NotFoundException;
use ReflectionException;
use ReflectionMethod;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * GET
     * @param $path
     * @param $callback
     */
    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * Check if a route matches with ':' which indicates it is dynamic
     * @throws NotFoundException
     */
    public function routeMatch($path, $method, $urlFragments)
    {
        foreach (array_keys($this->routes[$method]) as $route) {
            $routeList = explode('/', $route);
            array_shift($routeList);

            if (strpos($route, $urlFragments[0]) &&
                strpos($route, ':') &&
                count($routeList) > 1) {
                if ($routeList[0] === $urlFragments[0]) {
                    $path = $route;
                } else {
                    throw new NotFoundException();
                }
            }
        }

        return $this->routes[$method][$path] ?? false;
    }



    /**
     * @throws ReflectionException
     * @throws NotFoundException
     */
    public function resolve()
    {
        $method = $this->request->method();
        $path = $this->request->getPath();
        $urlFragments = $this->request->getUrlFragments($path);

        $callback = $this->routeIsValid($method, $path, $urlFragments);

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->view($callback);
        }

        if (is_array($callback)) {
            $controller = $this->newControllerInstance($callback[0]);
            $method = $callback[1];
            $this->runMiddleware($controller);

            // Set controller object at callback[0]
            $callback[0] = $controller;

            $params = $this->getMethodParams($controller, $method);

            if (!empty($params)) {
                $params = $this->resolveParams($params, $urlFragments);
                return call_user_func_array($callback, $params);
            }
        }

        return $callback($this->request, $this->response);
    }


    /**
     * @param Controller $controller
     * @param string $method
     * @return array
     * @throws ReflectionException
     */
    private function getMethodParams(Controller $controller, string $method): array
    {
        $reflection = new ReflectionMethod($controller, $method);
        return $reflection->getParameters();
    }


    /**
     * @throws NotFoundException
     */
    private function routeIsValid(string $method, string $path, array $urlFragments)
    {
        // Check if url path and method type exists in routes array
        $callback = $this->routes[$method][$path] ?? false;

        // If route not exists, check if route is dynamic
        if (!$callback) {

            $callback = $this->routeMatch($path, $method, $urlFragments);

            // If the route is not dynamic
            if (!$callback) {
                throw new NotFoundException();
            }
        }

        return $callback;
    }


    private function newControllerInstance(string $className)
    {
        return Application::$app->controller = new $className();
    }


    private function runMiddleware(Controller $controller): void
    {
        foreach ($controller->getMiddleware() as $middleware) {
            $middleware->handle();
        }
    }

    private function resolveParams(array $params, array $urlFragments): array
    {
        $parameters = [];
        foreach ($params as $param) {
            if (strpos((string)$param, 'request')) {
                $parameters[] = $this->request;
            } else if (strpos((string)$param, 'id')) {
                $parameters[] = (int) $urlFragments[1];
            } else if (strpos((string)$param, 'name')) {
                $parameters[] = $urlFragments[1];
            }
        }
       return $parameters;
    }


    /**
     * @param string $view
     * @param array $data
     * @return bool|array|string
     */
    public function view(string $view, array $data = []): bool|array|string
    {
        return Application::$app->view->renderView($view, $data);
    }

}