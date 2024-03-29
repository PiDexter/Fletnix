<?php


namespace app\src\models;


use app\src\core\database\QueryBuilder;
use app\src\core\Model;
use PDO;

class Movie extends Model
{
    /**
     * @param int $id
     * @return string
     */
    public function getMovieDirectorByID(int $id): string
    {
        $this->builder->select(['*'], 'person');
        $this->builder->join('movie_director', ['person.person_id' => 'movie_director.person_id']);
        $this->builder->where("movie_director.movie_id", '=', $id);
        $director = $this->builder->query()->fetch();

        if (!$director) {
            $director = 'Unknown';
        } else {
            $director = $director['firstname'] . " " . $director['lastname'];
        }

        return $director;
    }


    /**
     * @param int $id
     * @return array
     */
    public function getCastByID(int $id): array
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

    /**
     * @param string $genre
     * @return array
     */
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