<?php

declare(strict_types=1);

namespace app\src;

class Application
{

    public static string $ROOT_DIR;

    public Request $request;
    public Router $router;

    public function __construct($rootPath)
    {
        // Zet de applicatie root pad
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    // Resolves elke nieuwe request
    public function run() {
        echo $this->router->resolve();
    }

}