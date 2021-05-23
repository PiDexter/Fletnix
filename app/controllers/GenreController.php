<?php


namespace app\controllers;


use app\models\Genre;
use app\src\Controller;

class GenreController extends Controller
{

    // Toon alle genres
    public function index()
    {
        $genre = (new Genre())->getAll();
        return $this->render('genre', $genre);
    }

    // Toon van een bepaald genre de bijhorende movies
    public function show($name)
    {
        $genre = (new Genre())->where('genre_name', '=', $name)->fetch();

        // Als genre niet gevonden kan worden
        if (!$genre) {
            return $this->render('404');
        }

        $viewData = [
          'genreName' => $genre['genre_name']
        ];

        return $this->render('genre', $viewData);

    }

}