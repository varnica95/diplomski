<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Includes\ParametersValidation;
use App\Models\KidneyDisease;

class Parameters extends Controller
{
    public function index()
    {
        echo $this->view->render('Check/index.phtml');
    }

    public function submit()
    {
        if (isset($_POST['check-submit'])) {
            $validation = new ParametersValidation($_POST);

            if (!$validation->isPassed()) {
                echo $this->view->render('Check/index.phtml', [
                    'errors' => $validation->getError()
                ]);
            } else {
                $test = new KidneyDisease($_POST);
                $test->generateTests();

                echo $this->view->render('Check/index.phtml', [
                    'success' => "Submited"
                ]);
            }
        }
    }
}