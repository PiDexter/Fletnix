<?php


namespace app\controllers;


use app\src\Controller;

class GenreController extends Controller
{

    // Toon alle genres
    public function index()
    {
        return $this->render('genre');
    }

    // Toon movies van een genre via genre ID
    public function show($id)
    {

    }

}