<?php


namespace app\controllers;


use app\models\Genre;
use app\src\Controller;

class GenreController extends Controller
{

    // Toon alle genres
    public function index()
    {
        $genre = (new Genre())->all();
        return $this->render('genre', $genre);
    }

    // Toon van een bepaald genre de bijhorende movies
    public function show($name)
    {
        $genreMovies = (new Genre())->getMoviesByGenre($name);

        // Als genre niet gevonden kan worden
        if (!$genreMovies) {
            return $this->render('404');
        }



        return $this->render('genre_single', $genreMovies);

    }

}