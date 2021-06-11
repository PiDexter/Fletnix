<?php


namespace app\src\models;


use app\src\core\Model;
use PDO;

class Genre extends Model
{
    protected string $primaryKey = 'name';

    public function getMovies(): array
    {
        return $this->allWith('movie_genre', ['genre.genre_name' => 'movie_genre.genre_name']);
    }

    public function getMoviesByGenre(string $genre, int $page): array
    {
        return $this->builder->select(['*'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->where('movie_genre.genre_name', '=', $genre)
            ->orderBy(['movie.movie_id'], 'ASC')
            ->groupBy(['movie.movie_id'])
            ->limit(($page-1) * $this->perPage, $this->perPage)
            ->query()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovieCountByGenre(string $genre): int
    {
        return count($this->builder->select(['*'], 'movie')
            ->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id'])
            ->where('movie_genre.genre_name', '=', $genre)
            ->orderBy(['movie.movie_id'], 'ASC')
            ->query()->fetchAll(PDO::FETCH_ASSOC));
    }
}