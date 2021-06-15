<?php


namespace app\src\controllers\auth;


use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\models\User;

class LoginController extends Controller
{
    public function index(): bool|array|string
    {
        return $this->render('auth/login');
    }

    public function login(Request $request): bool|array|string
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
            'email' => $request['email'],
            'error' => 'Login failed, try again or create an account.'
        ];

        return $this->render('auth/login', $data);
    }
}