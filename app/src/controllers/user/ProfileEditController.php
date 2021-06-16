<?php


namespace app\src\controllers\user;


use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\core\Validator;
use app\src\middleware\AuthMiddleware;
use app\src\models\User;


class ProfileEditController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index(): bool|array|string
    {
        $user = (new User)->findByID(Application::$app->session->get('user'));
        return $this->render('user/edit_account', $user);
    }

    public function update(Request $request)
    {
        $request = $request->getBody();

        $rules = [
            'first_name' => ['required', ['min' => 1], ['max' => 40], 'string'],
            'last_name' => ['required', ['min' => 1], ['max' => 40], 'string'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string'],
            'bank_number' => ['required', 'numeric', ['min' => 8], ['max' => 20]]
        ];

        $data = [
            'email' => $request['email'],
            'first_name' => $request['name'],
            'last_name' => $request['lastName'],
            'country' => $request['country'],
            'date_of_birth' => $request['date_of_birth'],
            'bank_number' => $request['bank_number']
        ];

        $validatedData = new Validator($request, $rules);

        if ($validatedData->hasErrors()) {
            $data['error'] = $validatedData->getErrors();
        } else {
            $user = (new User)->findByID(Application::$app->session->get('user'));
            (new User)->update($user['user_id'], $data);
            Application::$app->response->redirect('/profile/edit');
        }

        return $this->render('user/edit_account', $data);
    }

}