<?php

namespace app\src\controllers\auth;

use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\core\Validator;
use app\src\middleware\AuthMiddleware;
use app\src\models\User;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        return $this->render('user/edit_password');
    }

    public function update(Request $request): bool|array|string
    {
        $formData = $request->getBody();
        $user = (new User)->findByID(Application::$app->session->get('user'));

        $rules = [
            'password' => ['required', 'password:confirm'],
            'confirm_password' => ['required'],
        ];
        $validatedData = new Validator($formData, $rules);


        if (!$validatedData->hasErrors() && password_verify($formData['current_password'], $user['password'])) {

            $data = [
                'password' => password_hash($formData['password'], PASSWORD_DEFAULT),
            ];

            (new User)->update($user['user_id'], $data);

            $data['message'] = 'Password changed successfully';
            return $this->render('user/edit_password', $data);
        }

        $data['error'] = $validatedData->getErrors();
        return $this->render('user/edit_password', $data);
    }

}