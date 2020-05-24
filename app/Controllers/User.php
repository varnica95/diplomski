<?php


namespace App\Controllers;


use App\Core\Config;
use App\Core\Controller;
use App\Includes\Cookie;
use App\Includes\Session;
use App\Models\Results;

class User extends Controller
{

    public function results()
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


    public function logout()
    {
        \App\Models\User::deletecookie(Session::get('id'));
        Session::destroy();
        Cookie::delete(Config::getInstance()->getConfig("rememberme/cookie_name"));

        echo $this->view->render('Home/index.phtml');
    }

    public function settings()
    {

    }
}