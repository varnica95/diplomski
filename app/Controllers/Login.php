<?php

namespace App\Controllers;

use App\Core\Controller;

class Login extends Controller
{
    public function index()
    {
        echo $this->view->render('Login/index.phtml');
    }
}