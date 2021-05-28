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

        if(!empty($request)) {
            if ($user->exists('email', $request['email'])) {
                if(password_verify($request['password'], $user->fetch('email', $request['email'])['password'])) {
                    Application::$app->session->set('user',$user->fetch('email', $request['email'])['user_id']);
                    Application::$app->session->set('user_name', $user->fetch('email', $request['email'])['first_name']);
                    Application::$app->response->redirect('/');
                }
            }
        } else {
            Application::$app->response->redirect('/login');
        }
    }

    public function logout()
    {
        Application::$app->session->remove();
        Application::$app->response->redirect('/');
    }

}