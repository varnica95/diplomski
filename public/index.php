<?php

define('BP', dirname(__DIR__));

require "../vendor/autoload.php";

$router = new \App\Core\Router();

$router->start();