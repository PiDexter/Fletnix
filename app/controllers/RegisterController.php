<?php


namespace app\controllers;


use app\models\User;
use app\src\Application;
use app\src\Controller;
use app\src\Model;
use app\src\Request;
use app\src\Validator;

class RegisterController extends Controller
{
    public function index(): bool|array|string
    {
        return $this->render('register');
    }

    public function create(Request $request): bool|array|string
    {
        $request = $request->getBody();
        $errors = [];

        $rules = [
            'first_name' => ['required', ],
            'email' => ['required', 'type:email']
        ];


        $validator = new Validator();
        $validate = $validator->validate($request, $rules);
//
//        var_dump($request);

//        foreach ($request as $key => $value) {
//
//            if (array_key_exists($key, $rules)) {
//
//                foreach ($rules[$key] as $rule) {
//
//                    switch ($rule) {
//                        case 'required':
//                            if (empty($value)) {
//                                $errors[] = 'Required field cannot be empty';
//                            }
//                            break;
//
//                        case 'type:email':
//                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
//                                $errors[] = 'Email address is not valid';
//                            }
//                            break;
//
//                        case 'numeric':
//                            if (!is_numeric($value)) {
//                                $errors[] = 'Only numbers are accepted';
//                            }
//                            break;
//
//                        case 'string':
//                            if (!is_string($value)) {
//                                $errors[] = 'Only letters are accepted';
//                            }
//                            break;
//                    }
//                }
//
//            }
//        }

;

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


        if ($validator->hasErrors()) {
            $user[] = $validate;
            var_dump($user);
            return $this->render('register', $user);
        }

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