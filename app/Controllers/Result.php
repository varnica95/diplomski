<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Includes\Session;
use App\Models\Results;

class Result extends Controller
{
    public function index()
    {
        $results = new Results(Session::get("id"), 1);

        echo $this->view->render('Results/index.phtml', [
           'row' => $results->getUserResults()
            ]);
    }

    public function details($id)
    {
        echo $this->view->render('Results/details.phtml', [
            'row' => Results::loadDetails($id)
        ]);
    }
}