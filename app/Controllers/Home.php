<?php

namespace App\Controllers;

use App\Core\Controller;

class Home extends Controller
{
    public function index()
    {
        echo $this->view->render('Home/index.phtml');
    }
}