<?php


namespace app\controllers;


use app\models\Genre;
use app\src\Controller;
use app\src\QueryBuilder;
use app\src\Request;

class SearchFilterController extends Controller
{
    public function index()
    {
        $data = (new Genre)->fetchColumn('genre_name');
//        var_dump($data);
        return $this->render('search_filter', $data);
    }

    public function filter(Request $request)
    {
        $searchData = $request->getBody();
        $builder = new QueryBuilder();
        $builder->select(['*'], 'movie');


        if (!empty($searchData['title'])) {
            $value = '%' . htmlspecialchars($searchData['title']) . '%';
            $builder->where('movie.title', 'LIKE', $value);
        }

        if (!empty($searchData['genre'])) {
            $value = htmlspecialchars($searchData['genre']);
            $builder->join('movie_genre', ['movie.movie_id' => 'movie_genre.movie_id']);
            $builder->where('movie_genre.genre_name', '=', $value);
        }

        if (!empty($searchData['publicationYear'])) {
            $value = (int) htmlspecialchars($searchData['publicationYear']);
            $builder->where('movie.publication_year', '=', $value);
        }


        if (!empty($searchData['director'])) {
            $value = '%' . htmlspecialchars($searchData['director']) . '%';

            $builder->join('movie_director', ['movie.movie_id' => 'movie_director.movie_id']);
            $builder->join('person', ['movie_director.person_id' => 'person.person_id']);

            $builder->where('person.firstname', 'LIKE', $value);
            $builder->orWhere('person.lastname', 'LIKE', $value);
        }

        $data = $builder->query()->fetchAll();
        return $this->render('search_result', $data);
    }

    public function result()
    {
        return $this->render('search_result');
    }

}