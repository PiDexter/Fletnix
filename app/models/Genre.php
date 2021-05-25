<?php


namespace app\models;


use app\src\Model;
use PDO;

class Genre extends Model
{
    protected string $primaryKey = 'name';

    public function getMovies()
    {
        return $this->builder->select(['*'], $this->getTable())
            ->join('movie_genre', ['genre.genre_name' => 'movie_genre.genre_name'])
            ->query()->fetchAll(PDO::FETCH_ASSOC);

//        return $this->builder->select(['*'], $this->getTable())->query()->fetchAll();
    }
}