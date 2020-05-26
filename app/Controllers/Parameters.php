<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Includes\ParametersValidation;
use App\Models\Kidney;

class Parameters extends Controller
{
    public function index()
    {
        echo $this->view->render('Predict/index.phtml');
    }

    public function submit()
    {
        if (isset($_POST['check-submit'])) {
            $validation = new ParametersValidation($_POST);

            if (!$validation->isPassed()) {
                echo $this->view->render('Predict/index.phtml', [
                    'errors' => $validation->getError()
                ]);
            } else {
                $test = new Kidney($_POST);
                $test->generateTests();

                echo $this->view->render('Predict/index.phtml', [
                    'success' => "Submited"
                ]);
            }
        }
    }
}