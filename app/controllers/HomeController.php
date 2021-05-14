<?php

namespace app\controllers;

use app\src\Application;
use app\src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('index');
    }

}