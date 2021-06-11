<?php


namespace app\src\controllers;



use app\src\core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return $this->render('about');
    }

}