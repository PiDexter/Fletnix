<?php


namespace app\models;


use app\src\Model;
use app\src\QueryBuilder;
use PDO;

class Movie extends Model
{

    public function getMovieDetails($id): array
    {
        $builder = new QueryBuilder();
        $builder->select(['*'], $this->getTable());
        $builder->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id']);
        $builder->join('movie_director', ['movie.movie_id' => 'movie_director.movie_id']);
        $builder->join('person', ['movie_director.person_id' => 'person.person_id']);
        $builder->where("movie." . $this->getPrimaryKey(), '=', $id);
        return $builder->query()->fetch();
    }

    public function getMovieDirectorByID($id): string
    {
        $this->builder->select(['*'], 'person');
        $this->builder->join('movie_director', ['person.person_id' => 'movie_director.person_id']);
        $this->builder->where("movie_director.movie_id", '=', $id);
        $director = $this->builder->query()->fetch();

        if (!$director) {
            $director = 'Onbekend';
        } else {
            $director = $director['firstname'] . " " . $director['lastname'];
        }

        return $director;
    }


    public function getCastByID($id): array
    {
        $builder = new QueryBuilder();
        $builder->select(['*'], 'movie_cast');
        $builder->join('person', ['movie_cast.person_id' => 'person.person_id']);
        $builder->where("movie_cast.movie_id", '=', $id);
        $castList = $builder->query()->fetchAll(PDO::FETCH_ASSOC);

        // When no cast is found, return empty array
        if (!$castList) {
            $castList = array();
        }

        return $castList;
    }

    public function trending(): array
    {
        return $this->builder
            ->select(['movie.movie_id', 'movie.title', 'movie_genre.genre_name'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->limit(10, 6)
            ->query()->fetchAll();
    }

    public function getByGenre(string $genre): array
    {
        return $this->builder
            ->select(['movie.movie_id', 'movie.title', 'movie_genre.genre_name'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->where('movie_genre.genre_name', '=', $genre)
            ->limit(0, 6)
            ->query()->fetchAll();
    }


}