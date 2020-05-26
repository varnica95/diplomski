<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Includes\Session;
use App\Models\Results;

class Result extends Controller
{
    public function index()
    {
        $results = new Results(Session::get("id"));

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

    public function delete($id)
    {
        Results::sdelete($id);

        $results = new Results(Session::get("id"));

        echo $this->view->render('Results/index.phtml', [
            'row' => $results->getUserResults()
        ]);
    }

}