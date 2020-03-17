<?php

namespace App\Includes;

class Session
{
    public static function start()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        else{
            return false;
        }
    }

    public static function destroy()
    {
        if(isset($_SESSION))
        {
            session_unset();

            session_destroy();

        }
    }
}