<?php

declare(strict_types=1);

namespace app\src;

class Router
{
    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = new Request();
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

    public function resolve()
    {
        // Ontvang het pad (string) van de request (voorbeeld pad: /contact)
        $path = $this->request->getPath();
        // Welke methode is gebruikt? (get, post etc)
        $method = $this->request->getMethod();

        // Bestaat de route met bijhorende method, sla op in callback variabele
        $callback = $this->routes[$method][$path] ?? false;

        // Als callback functie niet bestaat
        if ($callback === false) {
            return "Not found";
        }

        // Als de callback geen functie maar string is, return dan een view
        if (is_string($callback)) {
            return $this->render($callback);
        }

        // Voert methode die bij het pad in de array routes hoort uit
        return call_user_func($callback);
    }


    public function render($view) {

        // Haal de main layout op
        $layout = $this->layoutContent();
        $view = $this->renderView($view);

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

    protected function renderView($view) {

        // Bewaard alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();

        //  Haal de main layout
        include_once Application::$ROOT_DIR."/views/$view.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }

}