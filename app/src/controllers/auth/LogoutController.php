<?php


namespace app\src\controllers\auth;


use app\src\core\Application;
use app\src\core\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        Application::$app->session->remove();
        Application::$app->response->redirect('/');
    }
}