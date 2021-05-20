<?php


namespace app\controllers;


use app\src\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        
        return $this->render('register');
    }

}