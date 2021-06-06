<?php


namespace app\controllers;


use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Model;
use app\src\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->render('register');
    }

    public function create(Request $request)
    {
        $request = $request->getBody();

        // TODO: return error messages

        $user = [
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_DEFAULT),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'country' => $request['country'],
            'date_of_birth' => $request['date_of_birth'],
            'bank_number' => $request['bank_number'],
        ];

        if ($request['password'] !== $request['confirm_password']) {
            return $this->render('register', $user);
        }

        if ((new User)->getByEmail($request['email'])) {
            return $this->render('register', $user);
        }


        (new User)->create($user);
        Application::$app->response->redirect('/login');

        return $this->render('register', $user);
    }

}