<?php


namespace app\src\controllers\user;


use app\src\core\Application;
use app\src\core\Controller;
use app\src\middleware\AuthMiddleware;
use app\src\models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        $user = (new User)->findByID(Application::$app->session->get('user'));
        return $this->render('user/profile', $user);
    }
}