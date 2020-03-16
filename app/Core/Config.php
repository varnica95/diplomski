<?php

namespace App\Core;

class Config
{
    private $_config;

    private static $_instance;

    public function __construct()
    {
        $this->_config = require "environment.php";
    }

    public function getConfig($path = null)
    {
        $temp = $this->_config;

        if ($path) {
            $path = explode("/", $path);
            foreach ($path as $part) {
                if (isset($temp[$part]))
                    $temp = $temp[$part];
            }

            return $temp;
        }
    }

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}