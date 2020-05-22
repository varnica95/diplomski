<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Includes\Session;

class User extends Controller
{
    public function register()
    {

    }

    public function login()
    {
        if (isset($_POST["login-submit"]))
        {

            if (isset($_POST['remember']))
                $remember = ($_POST['remember'] === 'on') ? true : false;
            else
                $remember = false;

            $user = new \App\Models\User($_POST);

            if (!$user->userlogin($remember)) {
                echo $this->view->render('Login/index.phtml', [
                    'errors' => $user->getError(),
                ]);
            } else {
                echo $this->view->render('Home/index.phtml', [
                    'userlogged' => "Welcome, ". Session::get("firstname") . " " . Session::get("lastname")
                ]);
            }
        }

    }

    public function results()
    {

    }

    public function logout()
    {

    }

    public function settings()
    {

    }
}