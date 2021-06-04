<?php


namespace app\models;


use app\src\Model;
use app\src\QueryBuilder;

class Movie extends Model
{

    public function getAll($page)
    {
        $builder = new QueryBuilder();
        $builder->select(['*'], $this->getTable());
        $builder->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id']);
        $builder->join('movie_director', ['movie.movie_id' => 'movie_director.movie_id']);
        $builder->join('person', ['movie_director.person_id' => 'person.person_id']);
        $builder->orderBy(['movie.movie_id'], 'ASC');
        $builder->limit($page, $this->perPage);

        return $builder->query()->fetchAll();
    }

    public function getMovies()
    {
        $builder = new QueryBuilder();
        $builder->select(['*'], $this->getTable());
        $builder->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id']);
        $builder->join('movie_director', ['movie.movie_id' => 'movie_director.movie_id']);
        $builder->join('person', ['movie_director.person_id' => 'person.person_id']);
//        $builder->groupBy(['movie.movie_id']);
//        $builder->orderBy(['movie.movie_id'], 'ASC');

        return $builder->query()->fetchAll();
    }

}