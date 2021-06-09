<?php


namespace app\controllers;


use app\middleware\AuthMiddleware;
use app\models\Movie;
use app\src\Controller;
use app\src\NotFoundException;

class PlayMovieController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware());
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $id): bool|array|string
    {
        $movie = new Movie();
        $movieDetails = $movie->findByID($id);

        if (!$movieDetails) {
            throw new NotFoundException();
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