<?php


namespace app\controllers;


use app\src\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return $this->render('about');
    }

}