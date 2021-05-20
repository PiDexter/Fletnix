<?php


namespace app\controllers;


use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Request;

class AuthController extends Controller
{
    public function index() {
        return $this->render('login');
    }

    public function login(Request $request)
    {
        $request = $request->getBody();
        $user = new User();

        if(!empty($request) && $user->exists($request['email'])) {
            if(password_verify($request['password'], $user->fetch()['password'])) {
                Application::$app->session->set('user',$user->fetch()['user_id']);
                Application::$app->response->redirect('/');
            }
        }
    }

}