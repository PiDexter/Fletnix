<?php


namespace app\src\controllers;




use app\src\core\Controller;
use app\src\core\Request;
use app\src\models\Genre;

class GenreController extends Controller
{

    // Toon alle genres
    public function index()
    {
        $genres = (new Genre())->all();

        return $this->render('genre', $genres);
    }

    // Toon van een bepaald genre de bijhorende movies
    public function show(Request $request, string $name)
    {
        $page = $request->getBody()['page'] ?? 1;
        $genreMovies = (new Genre())->getMoviesByGenre($name, $page);
        $count = (new Genre)->getMovieCountByGenre($name);
        $total_pages = ceil($count / 15);

        $data = [
            'page_title' => $name,
            'count' => $count,
            'page' => $page,
            'total_pages' => $total_pages,
            'movies' => $genreMovies,
        ];


        // Als genre niet gevonden kan worden
        if (!$genreMovies) {
            return $this->render('404');
        }

        return $this->render('movies_overview', $data);
    }

}