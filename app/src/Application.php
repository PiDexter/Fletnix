<?php

declare(strict_types=1);

namespace app\src;

class Application
{

    public static Application $app;
    public static string $ROOT_DIR;

    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    public Database $db;


    public function __construct(string $rootPath, array $config)
    {
        // Zet de applicatie root pad
        self::$ROOT_DIR = $rootPath;

        // Er mag maar één instantie van deze class bestaan (Singleton)
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    // Resolves elke nieuwe request
    public function run() {
        echo $this->router->resolve();
    }

}