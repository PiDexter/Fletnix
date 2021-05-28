<?php


namespace app\controllers\auth;


use app\middleware\AuthMiddleware;
use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Request;

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

    public function update(Request $request)
    {
        $formData = $request->getBody();

        $data = [
            'email' => $formData['email'],
            'first_name' => $formData['name'],
            'last_name' => $formData['lastName'],
            'country' => $formData['country'],
            'date_of_birth' => $formData['dateOfBirth'],
        ];
        $user = (new User)->findByID(Application::$app->session->get('user'));
        (new User)->update($user['user_id'], $data);

        Application::$app->response->redirect('/profile');
    }

}