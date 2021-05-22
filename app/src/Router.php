<?php

declare(strict_types=1);

namespace app\src;

use app\controllers\MovieController;
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

    public function createDynamicRoute(array $params)
    {
        if (count($params) > 1) {
            $this->get('/movie/' . $params[1], [MovieController::class, 'show']);
        }
    }




    public function resolve()
    {
        // Ontvang het pad (string) van de request (voorbeeld pad: /contact)
        $path = $this->request->getPath();
        // Welke methode is gebruikt? (get, post etc)
        $method = $this->request->method();
        // Welke parameters heeft de url
        $urlParams = $this->request->getParams($path);

        var_dump($path);
        var_dump(count($urlParams));
        var_dump($urlParams[0]);

        echo '-----';

        var_dump($path);
        foreach (array_keys($this->routes[$method]) as $route) {
            $routes = explode('/', $route);
            array_shift($routes);

            if (strpos($route, 'movie') && strpos($route, ':')) {
//                $test[] = $route;
//                $route = explode('/', filter_var(rtrim($route, '/')), FILTER_SANITIZE_URL);
//                $route[2] = 5;
//                $match[] = str_replace(':id', '4', array_keys($this->routes[$method]));
//                $this->routes[$method][$route] = $route;
                var_dump($route);
                $path = $route;
            }
        }

        var_dump($path);
//        var_dump($this->routes);







//        // Als het url pad groter is dan 1, dan zijn de volgende stukken parameters
//        if (count($urlParams) > 1) {
//            $this->get('/movie/' . $urlParams[1], [MovieController::class, 'show']);
//        }



        $callback = $this->routes[$method][$path] ?? false;

        var_dump($callback);

        // Als route niet bestaat
        if (!$callback) {

            // Zet de status code van de response op 404 (not found)
            $this->response->setStatusCode(404);
            return "Not found";
        }

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->view($callback);
        }

        if (is_array($callback)) {
            // Instantieer een specifieke controller instantie
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }


        $r = new ReflectionMethod($callback[0], $callback[1]);
        $params = $r->getParameters();
        $parameters = [];
        foreach ($params as $param) {
            $parameters[] = $param->getName();
            var_dump($param);
        }

//        $test[] = $this->request;
        $test[] = $urlParams[1];

//        var_dump($parameters);


//        return call_user_func_array($callback, array());
        return call_user_func_array($callback, $test);

        // Voer methode die bij het pad in de array routes hoort uit
//        return call_user_func($callback, $this->request);
    }

    public function view($view, $data = [])
    {
        return Application::$app->view->renderView($view, $data);
    }

}