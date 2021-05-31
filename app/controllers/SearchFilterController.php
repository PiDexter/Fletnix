<?php


namespace app\controllers;


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
        $query = [];

        var_dump($searchData);

        if (!empty($searchData['title'])) {

        }

        if (!empty($searchData['genre'])) {

        }

        if (!empty($searchData['startDate'])) {

        }

        if (!empty($searchData['endDate'])) {

        }



        Application::$app->response->redirect('results');
    }

    public function result()
    {
        return $this->render('search_result');
    }

}