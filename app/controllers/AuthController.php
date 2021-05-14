<?php


namespace app\controllers;


use app\src\Application;
use app\src\Controller;

class AuthController extends Controller
{

    public function index() {

        $params = [
            'name' => "Chris"
        ];
        return $this->render('login', $params);
    }

}