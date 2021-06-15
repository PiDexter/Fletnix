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
     * @throws NotFoundException
     */
    public function routeMatch($path, $method, $urlFragments) {

//            // Alle keys uit $routes[] als $route
//            // Voorbeeld:
//            // [
//            // '/',
//            // '/movie',
//            // '/movie/:id'
//            // ]

        foreach (array_keys($this->routes[$method]) as $route) {
            $routes = explode('/', $route);
            array_shift($routes);


            // Wanneer in de routes array een route matched met de eerst url param
            // EN deze route ook matched met een ":" dan staat er een variabele in de route
            // Zet nu het huidige pad (bijv: movies/5) naar "movies/:id"
            // Omdat movies/5 geen route in de routes array is maar movies/id wel

            if (strpos($route, $urlFragments[0]) &&
                strpos($route, ':') &&
                count($routes) > 1) {
                if ($routes[0] === $urlFragments[0]) {
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
        $path = $this->request->getPath();
        $method = $this->request->method();

        // Array of url fragments
        $urlFragments = $this->request->getUrlFragments($path);

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

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->view($callback);
        }

        if (is_array($callback)) {

            $controller = $this->newControllerInstance($callback[0]);
            $controllerMethod = $callback[1];
            $this->runMiddleware($controller);

            // Set controller object at callback[0]
            $callback[0] = $controller;

            // Check method parameters of the controller class by reflection
            $reflection = new ReflectionMethod($controller, $controllerMethod);
            // Kijk welke parameters de controller methode vraagt
            $params = $reflection->getParameters();

            if (!empty($params)) {
                $parameters = [];
                foreach ($params as $index => $param) {
                    var_dump($urlFragments);
                    // Als een parameters gelijk is aan 'request', geef het request object dan terug
                    // TODO: create method for reflection instances instead of temporary hardcoded match- and resolving method parameters.
                    if (strpos((string)$param, 'request')) {
                        $parameters[] = $this->request;
                    } else if (strpos((string)$param, 'id')) {
                        $parameters[] = (int) $urlFragments[1];
                    } else if (strpos((string)$param, 'name')) {
                        $parameters[] = $urlFragments[1];
                    }
                }
                var_dump($callback);
                var_dump($parameters);
                return call_user_func_array($callback, $parameters);
            }
        }

        return $callback($this->request, $this->response);
    }


    private function newControllerInstance(string $className)
    {
        return Application::$app->controller = new $className();
    }


    private function runMiddleware(Controller $controller)
    {
        foreach ($controller->getMiddleware() as $middleware) {
            $middleware->handle();
        }
    }


//    private function newCallbackInstance($callback)
//    {
//        // Instantieert een specifieke controller instantie
//        Application::$app->controller = new $callback[0]();
//        $callback[0] = Application::$app->controller;
//        foreach ($callback[0]->getMiddleware() as $middleware) {
//            $middleware->handle();
//        }
//    }

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