<?php


namespace app\controllers;


use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        $user = (new User)->findByID(Application::$app->session->get('user'));
        return $this->render('profile', $user);
    }

    public function updateDetails(Request $request): void
    {
        $formData = $request->getBody();

        $data = [
            'first_name' => $formData['name']
        ];
        $user = (new User)->findByID(Application::$app->session->get('user'));
        (new User)->update($user['user_id'], $data);

        Application::$app->response->redirect('/profile');
    }

    public function updatePassword(Request $request): void
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