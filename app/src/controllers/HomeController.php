<?php

namespace app\src\controllers;



use app\src\core\Controller;
use app\src\models\Movie;

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