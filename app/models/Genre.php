<?php


namespace app\models;


use app\src\Model;
use PDO;

class Genre extends Model
{
    protected string $primaryKey = 'name';

    public function getMovies()
    {
        return $this->allWith('movie_genre', ['genre.genre_name' => 'movie_genre.genre_name']);
    }

    public function getMoviesByGenre(string $genre)
    {
        return $this->builder->select(['*'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->where('movie_genre.genre_name', '=', $genre)
            ->query()->fetchAll(PDO::FETCH_ASSOC);
    }
}