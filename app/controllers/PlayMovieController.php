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

    public function show(int $id)
    {
        $movie = new Movie();

        $movieDetails = $movie->findByID($id);

        // Als movie niet gevonden kan worden
        if (!$movieDetails) {
            return $this->render('404');
        }

        $viewData = [
            'title' => $movieDetails['title'],
            'duration' => $movieDetails['duration'],
            'description' => $movieDetails['description'],
            'publication_year' => $movieDetails['publication_year'],
            'director' => $movie->getMovieDirectorByID($id),
            'movie_cast' => $movie->getCastByID($id)
        ];

        return $this->render('movie', $viewData);
    }
}