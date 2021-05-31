<?php


namespace app\controllers;


use app\models\Movie;
use app\src\Application;
use app\src\Controller;
use app\src\QueryBuilder;
use app\src\Request;

class SearchFilterController extends Controller
{
    public function index()
    {
        return $this->render('search_filter');
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


        if (!empty($searchData['firstName'])) {
            $builder->join('movie_director', ['movie.movie_id' => 'movie_director.movie_id']);
            $builder->join('person', ['movie_director.person_id' => 'person.person_id']);
            $value = '%' . htmlspecialchars($searchData['firstName']) . '%';
            $builder->where('person.firstname', 'LIKE', $value);
        }

        if (!empty($searchData['lastName'])) {
            $value = htmlspecialchars($searchData['lastName']);
            $builder->where('person.lastname', '=', $value);
        }

//       $this->data[] =
        $data = $builder->query()->fetchAll();
        return $this->render('search_result', $data);
//        var_dump($builder->query()->fetchAll());
//        Application::$app->response->redirect('results');
    }

    public function result()
    {
        return $this->render('search_result');
    }

}