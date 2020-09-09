<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Includes\RegistrationValidation;
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
            $validation = new RegistrationValidation($_POST);

            if(!$validation->isPassed()) {
                echo $this->view->render('Register/index.phtml', [
                    'errors' => $validation->getError()
                ]);
            }
            else{
                $user = new User($_POST);
                $user->newuser();

                echo $this->view->render('Register/index.phtml', [
                    'success' => 'Registration successfully completed.',
                    'errors' => $user->getError()
                ]);
            }
        }
    }
}