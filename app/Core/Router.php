<?php

namespace App\Core;

class Router
{
    protected $controller = 'home';

    protected $method = 'index';

    protected $parameters = [];


    protected function prepare()
    {
        $request = trim($_SERVER["REQUEST_URI"], "/");

        if(!empty($request))
        {
            $url = explode('/', $request);

            $this->controller = isset($url[0]) ? 'App\\Controllers\\' . ucfirst($url[0]) : 'Home';
            $this->method = isset($url[1]) ? $url[1] : 'index';

            unset($url[0], $url[1]);

            $this->parameters = !empty($url) ? array_values($url) : [];

        }else{
            $this->controller = 'App\\Controllers\\Home';
            $this->method = 'index';
        }
    }

    public function start()
    {
        $this->prepare();

        if(class_exists($this->controller))
        {
            $this->controller = new $this->controller;
        }else{
            echo "Page not found.";
        }

        if(method_exists($this->controller, $this->method))
        {
            call_user_func_array([$this->controller, $this->method], $this->parameters);
        }
    }

}