<?php

declare(strict_types=1);

namespace app\src;

use app\controllers\MovieController;
use ReflectionClass;
use ReflectionMethod;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
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
            var_dump($routes);

            // Wanneer in de routes array een route matched met de eerst url param
            // EN deze route ook matched met een ":" dan staat er een variabele in de route
            // Zet nu het huidige pad (bijv: movies/5) naar "movies/:id"
            // Omdat movies/5 geen route in de routes array is maar movies/id wel
            if (strpos($route, $urlFragments[0]) && strpos($route, ':')) {
                $path = $route;
            }

        }
        return $this->routes[$method][$path] ?? false;
    }



    /**
     * @throws \ReflectionException
     */
    public function resolve()
    {
        // Ontvang het pad (string) van de request (voorbeeld pad: /contact)
        $path = $this->request->getPath();
        // Welke methode is gebruikt? (get, post etc)
        $method = $this->request->method();

        // Verkrijg de url fragments in array
        $urlFragments = $this->request->getUrlFragments($path);

        // Check of de route bestaat
        $callback = $this->routes[$method][$path] ?? false;

        // Als route niet bestaat bekijk of er een route is die dynamisch is
        if (!$callback) {

            $callback = $this->routeMatch($path, $method, $urlFragments);

            // Als er geen dynamische route bestaat
            if (!$callback) {
                $this->response->setStatusCode(404);
                return "Not found";
            }
        }

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->view($callback);
        }

        if (is_array($callback)) {
            // Instantieert een specifieke controller instantie
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }


        $reflection = new ReflectionMethod($callback[0], $callback[1]);
        // Kijk welke parameters de controller methode vraagt
        $params = $reflection->getParameters();

        if (!empty($params)) {
            $parameters = [];
            foreach ($params as $param) {
                // Als een parameters gelijk is aan 'request', geef het request object dan terug
                // TODO dit is een tijdelijke workaround voor het matchen en resolve van method parameters
                if (strpos((string)$param, 'request')) {
                    $parameters[] = $this->request;
                } else if (strpos((string)$param, 'id')) {
                    $parameters[] = (int) $urlFragments[1];
                } else {
                    continue;
                }

            }
            return call_user_func_array($callback, $parameters);
        }

        return $callback($this->request, $this->response);
    }

    public function view($view, $data = [])
    {
        return Application::$app->view->renderView($view, $data);
    }

}