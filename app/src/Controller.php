<?php


namespace app\src;


abstract class Controller
{
    public function render($view, $data = [])
    {
        return Application::$app->router->view($view, $data);
    }
}