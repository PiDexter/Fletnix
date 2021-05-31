<?php


namespace app\controllers\auth;


use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        $user = (new User)->findByID(Application::$app->session->get('user'));
        return $this->render('auth/profile', $user);
    }
}