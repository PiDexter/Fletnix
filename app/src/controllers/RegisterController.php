<?php


namespace app\src\controllers;




use app\src\core\Application;
use app\src\core\Controller;
use app\src\core\Request;
use app\src\core\Validator;
use app\src\models\User;

class RegisterController extends Controller
{
    public function index(): bool|array|string
    {
        return $this->render('register');
    }

    public function create(Request $request): bool|array|string
    {
        $request = $request->getBody();

        $rules = [
            'first_name' => ['required', ['min' => 1], ['max' => 40], 'string'],
            'last_name' => ['required', ['min' => 1], ['max' => 40], 'string'],
            'email' => ['required', 'email', 'unique:email'],
            'country' => ['required', 'string'],
            'password' => ['password'],
            'bank_number' => ['required', 'numeric', ['min' => 8], ['max' => 20]]
        ];

        $user = [
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_DEFAULT),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'country' => $request['country'],
            'date_of_birth' => $request['date_of_birth'],
            'bank_number' => $request['bank_number'],
        ];

        $validatedData = new Validator($request, $rules);

        if ($validatedData->hasErrors()) {
            $user['error'] = $validatedData->getErrors();
        } else {
            (new User)->create($user);
            Application::$app->response->redirect('/login');
        }

        return $this->render('register', $user);
    }

}