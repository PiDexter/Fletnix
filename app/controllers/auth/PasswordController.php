<?php

namespace app\controllers\auth;

use app\middleware\AuthMiddleware;
use app\src\Controller;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function index()
    {
        return $this->render('auth/edit_password');
    }
}