<?php

namespace App\Models;

use App\Core\Model;

use App\Core\Database;
use App\Includes\ErrorHandlerTrait;

class User extends Model
{
    use ErrorHandlerTrait;

    private $_errors = [];

    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function newuser()
    {
        $this->usernameexists();
        $this->emailexists();


       // if($this->isPassed()) {
            $this->insert("users", $this->data);
        //}
    }

    private function usernameexists()
    {
        if(!empty($this->loadfromtable("users", "username", $this->data["username"])))
        {
            $this->makeError("exists", "Username ". $this->data["username"] . " already exists.");
        }
    }

    private function emailexists()
    {
        if(!empty($this->loadfromtable("users", "email", $this->data["email"])))
        {
            $this->makeError("exists", "Username ". $this->data["email"] . " already exists.");
        }
    }
}