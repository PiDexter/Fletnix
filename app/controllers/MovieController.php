<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Controller;

class MovieController extends Controller
{

    public function index()
    {
        $page = $_GET['page'] ?? 1;

        $data = (new Movie)->all();

//        $data = (new Movie)->getAll($page);

//        var_dump($movie->getCount());

        return $this->render('movies_overview', $data);
    }

    public function show(int $id)
    {
        $movie = (new Movie())->findByID($id);

        // Als movie niet gevonden kan worden
        if (!$movie) {
            return $this->render('404');
        }

        $viewData = [
            'title' => $movie['title'],
            'duration' => $movie['duration'],
            'description' => $movie['description'],
            'publicationYear' => $movie['publication_year']
        ];

        return $this->render('movie', $viewData);
    }

}