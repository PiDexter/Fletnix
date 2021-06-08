<?php

namespace app\controllers;

use app\src\Controller;
use app\src\QueryBuilder;

class HomeController extends Controller
{
    public function index()
    {
        $trending = (new QueryBuilder())
            ->select(['movie.movie_id', 'movie.title', 'movie_genre.genre_name'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->limit(10, 6)
            ->query()->fetchAll();

        $documentary = (new QueryBuilder())
            ->select(['movie.movie_id', 'movie.title', 'movie_genre.genre_name'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->where('movie_genre.genre_name', '=', 'Documentary')
            ->limit(0, 6)
            ->query()->fetchAll();

        $data = [
            'trending' => $trending,
            'documentary' => $documentary
        ];

        return $this->render('index', $data);
    }

}