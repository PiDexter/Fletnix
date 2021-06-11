<?php

namespace app\controllers;

use app\models\Movie;
use app\src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $trending = (new Movie)->trending();
        $documentary = (new Movie)->getByGenre('Documentary');

        $data = [
            'trending' => $trending,
            'documentary' => $documentary
        ];

        return $this->render('index', $data);
    }

}