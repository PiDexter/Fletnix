<?php

use app\src\Application;

if (! function_exists('view')) {
    /**
     * @param string $view
     * @param array $data
     * @return array|false|string|string[]
     */
    function view(string $view, array $data = [])
    {
        return Application::$app->router->renderView($view, $data);
    }
}
