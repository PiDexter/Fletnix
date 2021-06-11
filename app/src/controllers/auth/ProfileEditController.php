<?php


namespace app\src\controllers\auth;


use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\middleware\AuthMiddleware;
use app\src\models\User;


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