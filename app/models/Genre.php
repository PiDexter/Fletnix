<?php


namespace app\models;


use app\src\Model;

class Genre extends Model
{
    protected string $primaryKey = 'name';

    public function getMovies(): array
    {
        return $this->allWith('movie_genre', ['genre.genre_name' => 'movie_genre.genre_name']);
    }
}