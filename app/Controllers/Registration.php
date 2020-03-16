<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\User;

class Registration extends Controller
{
    public function index()
    {
        echo $this->view->render('Register/index.phtml');
    }

    public function signup()
    {
        if(isset($_POST["signup-submit"]))
        {
            $user = new User($_POST);
            $user->newuser();

            echo $this->view->render('Register/index.phtml', [
                'success' => 'Registration successfully completed.',
                'errors' => $user->getError()
            ]);
        }
    }
}