<?php

declare(strict_types=1);

namespace app\src;

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

    /**
     * GET
     * @param $path
     * @param $callback
     */
    public function get($path, $callback): void
    {
        // Bewaar de route met de uit te voeren functie (callback) nested array $routes
        // De nested array routes als voorbeeld:
        //    $routes = [
        //      'get' => [
        //        '/pad' => functie,
        //        '/contact' => callback functie
        //      ],
        //      'post' => [
        //
        //      ]
        //    ];
        $this->routes['get'][$path] = $callback;
    }

    // Zelfde als de get methode
    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        // Ontvang het pad (string) van de request (voorbeeld pad: /contact)
        $path = $this->request->getPath();
        // Welke methode is gebruikt? (get, post etc)
        $method = $this->request->method();

        // Bestaat de route met bijhorende method, sla op in callback variabele
        $callback = $this->routes[$method][$path] ?? false;

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

        // Voer methode die bij het pad in de array routes hoort uit
        return call_user_func($callback, $this->request);
    }

    public function view($view, $data = [])
    {
        return Application::$app->view->renderView($view, $data);
    }

}