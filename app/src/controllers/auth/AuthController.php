<?php


namespace app\src\controllers\auth;




use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\models\User;

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