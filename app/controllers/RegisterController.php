<?php


namespace app\controllers;


use app\models\User;
use app\src\Controller;
use app\src\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->render('register');
    }

    public function create(Request $request)
    {
        $formData = $request->getBody();

        var_dump($formData['email']);

        $userData = [
            'email' => $formData['email'],
            'password' => password_hash($formData['password'], PASSWORD_DEFAULT),
            'first_name' => $formData['name'],
            'last_name' => $formData['lastName'],
            'country' => $formData['country'],
            'date_of_birth' => $formData['dateOfBirth'],
        ];

        (new User())->create($userData);
        return $this->render('register');
    }

}