<?php

namespace app\controllers\auth;

use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Request;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index()
    {
        return $this->render('auth/edit_password');
    }

    public function update(Request $request)
    {
        $formData = $request->getBody();

        // TODO: VALIDATE CURRENT PASSWORD AND PROCESS UPDATE

        $data = [
            'password' => password_hash($formData['newPassword'], PASSWORD_DEFAULT),
        ];
        $user = (new User)->findByID(Application::$app->session->get('user'));
        (new User)->update($user['user_id'], $data);

        Application::$app->response->redirect('/profile');
    }
}