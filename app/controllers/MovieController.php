<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Controller;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        // When $_GET['page'] is not set, show page number 1
        $page = $request->getBody()['page'] ?? 1;
        $data = (new Movie)->findAll($page);

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