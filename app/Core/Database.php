<?php

namespace App\Core;

use PDO;

class Database
{
    private static $_instance;

    private $_pdo;

    private function __construct()
    {
        try{
            $this->_pdo = new \PDO(
                'mysql:host='. Config::getInstance()->getConfig("mysql/host").
                ';dbname=' . Config::getInstance()->getConfig("mysql/database"),
                Config::getInstance()->getConfig("mysql/username"),
                Config::getInstance()->getConfig("mysql/password")
            );
        }catch (PDOException $e){
            die($e->getMessage());
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

    public function getConnection()
    {
        return $this->_pdo;
    }
}