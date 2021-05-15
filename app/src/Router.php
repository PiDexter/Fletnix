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
        if ($callback === false) {
            // Zet de status code van de response op 404 (not found)
            $this->response->setStatusCode(404);
            return "Not found";
        }

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        // Voert methode die bij het pad in de array routes hoort uit
        return call_user_func($callback, $this->request);
    }


    public function renderView($view, $params = []) {
        // Haal de main layout op
        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $params);

        // Tag in html is gelijk aan de parameter naam
        // Parameter 'name' met waarde 'peter'
        // Vervangt in html {{name}} voor de waarde
        foreach ($params as $key => $value) {
            $view = str_replace("{{" . $key . "}}", (string) $value, $view);
        }


        // Vervang de string "{{content}}" met de inhoud van de view file in de layout
        return str_replace("{{content}}", $view, $layout);
    }

    protected function layoutContent() {

        // Bewaard alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();

        //  Haal de main layout
        include_once Application::$ROOT_DIR."/views/layout/main.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params) {

        // Zet parameter key als variable naam met als waarde de value
        extract($params);


        // Bewaard alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();

        //  Haal de main layout
        include_once Application::$ROOT_DIR."/views/$view.php";
        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }

}