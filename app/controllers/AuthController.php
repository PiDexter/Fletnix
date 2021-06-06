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

        $user = (new User)->getByEmail($request['email']);

        if (!empty($request) && !empty($user->email) && password_verify($request['password'], $user->password)) {
            Application::$app->session->set('user', $user->user_id);
            Application::$app->session->set('name', $user->first_name);
            // Redirect to home when login is success
            Application::$app->response->redirect('/');
        }

        $data = [
            'email' => $request['email']
        ];

        return $this->render('login', $data);
    }

    public function logout()
    {
        Application::$app->session->remove();
        Application::$app->response->redirect('/');
    }

}