<?php


namespace app\controllers;


use app\models\Genre;
use app\src\Controller;
use app\src\Request;

class GenreController extends Controller
{

    // Toon alle genres
    public function index()
    {
        $genre = (new Genre())->all();
        return $this->render('genre', $genre);
    }

    // Toon van een bepaald genre de bijhorende movies
    public function show(Request $request, string $name)
    {
        $page = $request->getBody()['page'] ?? 1;
        $genreMovies = (new Genre())->getMoviesByGenre($name, $page);

        // Als genre niet gevonden kan worden
        if (!$genreMovies) {
            return $this->render('404');
        }

        return $this->render('movies_overview', $genreMovies);
    }

}