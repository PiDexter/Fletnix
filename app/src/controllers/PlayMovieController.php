<?php


namespace app\src\controllers;


use app\src\core\Controller;
use app\src\exceptions\NotFoundException;
use app\src\middleware\AuthMiddleware;
use app\src\models\Movie;


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