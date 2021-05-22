<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Controller;
use app\src\Request;

class MovieController extends Controller
{

    public function index()
    {
    }

    public function show($id)
    {
        $movie = (new Movie())->where('movie_id', '=', $id)->fetch();

        // Als movie niet gevonden kan worden
        if (!$movie) {
            return $this->render('404');
        }
        var_dump($movie);
    }

}