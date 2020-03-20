<?php

namespace App\Includes;

class Validation
{
    use ErrorHandlerTrait;

    private $_errors = [];

    private $_data = [];

    public function __construct(array $params)
    {
        foreach ($params as $key => $value)
        {
            if($key !== "signup-submit")
            {
                $this->_data[$key] = $value;
            }

        }

        $this->validate();
    }

    public function emptyfields()
    {
        foreach ($this->_data as $key => $value)
        {
            if(empty($value))
            {
                if($key === "gender")
                    $this->makeError("gender", "Fields cannot be empty.");

                $this->makeError("empty", "Fields cannot be empty.");
            }
        }
    }

    public function name()
    {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $this->_data["firstname"]))
        {
            $this->makeError("firstname", "Name ". $this->_data["firstname"] . " is not valid.");
        }

        if (!preg_match("/^([a-zA-Z' ]+)$/", $this->_data["lastname"]))
        {
            $this->makeError("lastname", "Lastname ". $this->_data["lastname"] . " is not valid.");
        }
    }

    public function username()
    {
        if(strlen($this->_data["username"]) < 5)
        {
            $this->makeError("username", "Username is too short.");
        }
        else if (!preg_match("/^([a-zA-Z0-9' ]+)$/", $this->_data["username"]))
        {
            $this->makeError("username", "Username must contain only letters or numbers.");
        }
    }

    public function email()
    {
        if(!filter_var($this->_data["email"], FILTER_VALIDATE_EMAIL))
        {
            $this->makeError("email", "Email " . $this->_data["email"] ." is not valid.");
        }
    }

    public function password()
    {
        if(strlen($this->_data["password"]) < 5)
        {
            $this->makeError("password", "Password is too short");
        }
        else if(!preg_match("#[0-9]+#", $this->_data["password"]))
        {
            $this->makeError('password','Password must contain a number.');
        }
        else if(!preg_match("#[A-Z]+#", $this->_data["password"]))
        {
            $this->makeError('password', 'Password must contain a capital number.');
        }
        else if ($this->_data["password"] !== $this->_data["password-again"])
        {
            $this->makeError('password','Passwords do not match.');
        }
    }

    public function validate()
    {
        $this->emptyfields();
        $this->name();
        $this->username();
        $this->email();
        $this->password();
    }
}