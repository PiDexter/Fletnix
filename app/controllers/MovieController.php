<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Controller;
use app\src\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        // When $_GET['page'] is not set, show page number 1
        $page = $request->getBody()['page'] ?? 1;
        $movies = (new Movie)->findAll($page);

        $count = (new Movie)->getCount();
        $total_pages = ceil($count / 15);

        $data = [
            'page_title' => 'Alle films',
            'count' => $count,
            'page' => $page,
            'total_pages' => $total_pages,
            'movies' => $movies,
        ];

        return $this->render('movies_overview', $data);
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