<?php

namespace app\src\core;

use app\src\core\database\Database;
use Exception;

class Application
{

    public static Application $app;
    public static string $ROOT_DIR;

    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    public Database $db;

    public View $view;
    public Session $session;


    /**
     * Application constructor.
     * @param string $rootPath
     * @param array $config
     */
    public function __construct(string $rootPath, array $config)
    {
        // Only one instance may exists, creates a singleton of Application
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
        $this->view = new View();
        $this->session = new Session();
    }


    /**
     * Echo the final view
     * If route could not be resolved
     * Show error page with error message
     */
    public function run() {

        try {
            echo $this->router->resolve();
        } catch (Exception $exception) {

            $this->response->setStatusCode($exception->getCode());

            echo $this->router->view('error', [
                'error' => $exception
            ]);
        }

    }

}