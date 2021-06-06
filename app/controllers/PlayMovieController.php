<?php


namespace app\controllers;


use app\middleware\AuthMiddleware;
use app\models\Movie;
use app\src\Controller;

class PlayMovieController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    public function show(int $id): bool|array|string
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