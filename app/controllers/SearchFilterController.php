<?php


namespace app\controllers;


use app\models\Genre;
use app\src\Controller;
use app\src\QueryBuilder;
use app\src\Request;
use PDO;

class SearchFilterController extends Controller
{
    public function index()
    {
        $genres = (new Genre)->fetchColumn('genre_name');

        $data = [
            'genre' => $genres,
            'years' => range(strftime("%Y", time()), 1970)
        ];

        return $this->render('search_filter', $data);
    }

    public function show(Request $request): bool|array|string
    {
        $resultsPerPage = 15;

        $page = $request->getBody()['page'] ?? 1;
        $searchData = $request->getBody();

        $builder = new QueryBuilder();
        $builder->distinct()->select(['movie.movie_id', 'movie.title'], 'movie');

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

        $builder->limit(($page-1) * $resultsPerPage, $resultsPerPage);
        $results = $builder->query()->fetchAll(PDO::FETCH_ASSOC);

        $count = $builder->queryCount('movie', 'movie_id');
        $total_pages = ceil($count / 15);


        $data = [
            'search_params' => http_build_query([
                'title' => $searchData['title'],
                'genre' => $searchData['genre'],
                'publicationYear' => $searchData['publicationYear'],
                'director' => $searchData['director'],
            ]),
            'page_title' => 'Results',
            'count' => (int) $count,
            'page' => (int) $page,
            'total_pages' => $total_pages,
            'movies' => $results
        ];

        return $this->render('movies_overview', $data);
    }

}