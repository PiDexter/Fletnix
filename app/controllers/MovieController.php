<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Controller;
use app\src\Request;

class MovieController extends Controller
{

    /**
     * Show all available movies
     * @param Request $request
     * @return bool|array|string
     */
    public function index(Request $request): bool|array|string
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
}