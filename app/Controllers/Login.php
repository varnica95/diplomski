<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Includes\Cookie;
use App\Includes\Session;
use App\Models\User;
use App\Core\Config;

class Login extends Controller
{
    public function index()
    {
        echo $this->view->render('Login/index.phtml');
    }

    public function login()
    {
        if (isset($_POST["login-submit"]))
        {

            if (isset($_POST['remember']))
                $remember = ($_POST['remember'] === 'on') ? true : false;
            else
                $remember = false;

            $user = new User($_POST);

            if (!$user->userlogin($remember)) {
                echo $this->view->render('Login/index.phtml', [
                    'errors' => $user->getError(),
                ]);
            } else {
                echo $this->view->render('Home/index.phtml');
            }
        }
    }

    //public function logout()
  //  {
    //    User::deletecookie(Session::get('id'));
      //  Session::destroy();
        //Cookie::delete(Config::getInstance()->getConfig("rememberme/cookie_name"));

        //$this->index();
   // }
}