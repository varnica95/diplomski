<?php


namespace App\Controllers;


use App\Core\Config;
use App\Core\Controller;
use App\Includes\Cookie;
use App\Includes\ProfileSettingsValidation;
use App\Includes\Session;

class User extends Controller
{
    public function logout()
    {

        if(Cookie::exists(Config::getInstance()->getConfig("rememberme/cookie_name"))){
            \App\Models\User::deletecookie(Session::get('id'));
        }
        
        Session::destroy();
        Cookie::delete(Config::getInstance()->getConfig("rememberme/cookie_name"));

        echo $this->view->render('Home/index.phtml');
    }

    public function settings()
    {
        $settings = new \App\Models\User();

        echo $this->view->render('Settings/index.phtml',[
            "row" =>  $settings->getUserSettings()
        ]);
    }

    public function update()
    {
       if(isset($_POST["update-submit"]))
       {
            $validation = new ProfileSettingsValidation($_POST);

           if (!$validation->isPassed()) {
               echo $this->view->render('Settings/index.phtml', [
                   'errors' => $validation->getError()
               ]);
           } else {
               $settings = new \App\Models\User($_POST);
               $settings->updatepassword();

               echo $this->view->render('Settings/index.phtml', [
                   'success' => "Submited"
               ]);
           }
       }
    }

}