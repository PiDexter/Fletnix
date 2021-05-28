<?php


namespace app\controllers\auth;


use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;

class ProfileEditController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index()
    {
        $user = (new User)->findByID(Application::$app->session->get('user'));
        return $this->render('auth/edit_account', $user);
    }

}