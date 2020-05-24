<?php

use App\Core\Config;
use App\Includes\Cookie;

define('BP', dirname(__DIR__));

require "../vendor/autoload.php";

\App\Includes\Session::start();


if(Cookie::exists(Config::getInstance()->getConfig("rememberme/cookie_name")) && !$_SESSION)
{
    $hash = App\Includes\Cookie::get(Config::getInstance()->getConfig("rememberme/cookie_name"));
    $hashCheck = App\Models\User::checkhash($hash);
    if (!empty($hashCheck)) {
       \App\Includes\Session::start();
        \App\Includes\Session::set('id', $hashCheck->data['user_id']);
    }
}


$router = new \App\Core\Router();
$router->start();