<?php

namespace App\Models;

use App\Core\Model;

use App\Core\Database;
use App\Includes\ErrorHandlerTrait;
use App\Includes\Hash;
use App\Includes\Session;
use App\Includes\Cookie;
use App\Core\Config;

class User extends Model
{
    use ErrorHandlerTrait;

    private $_errors = [];

    private $_cookiename;

    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }

        $this->_cookiename = Config::getInstance()->getConfig("rememberme/cookie_name");
    }

    public function newuser()
    {
        $this->usernameexists();
        $this->emailexists();

        $this->data["password"] = password_hash($this->data['password'], PASSWORD_DEFAULT);

       if($this->isPassed()) {
            $this->insert("users", $this->data);
        }
    }

    public function userlogin($remember = false)
    {
        $loggeduser = $this->loaduser('users', ['username', 'email'], [$this->data['usernameoremail'], $this->data['usernameoremail']]);

        if(!empty($loggeduser)) {
            if (!password_verify($this->data["password"], $loggeduser->data["password"])) {
                $this->makeError("password", "Lozinka nije točna.");
                return false;
            } else {
                Session::set('id', $loggeduser->data['id']);

                if($remember)
                {
                    $hash = Hash::unique();
                    $hashCheck = $this->checkrememberme();

                    if(!$hashCheck)
                    {
                        $this->insert("rememberme", [
                            'user_id' => $loggeduser->data["id"],
                            'hash' => $hash
                        ]);
                    }
                    else{
                        $hash = $hashCheck->data['hash'];
                    }
                        Cookie::put($this->_cookiename, $hash, Config::getInstance()->getConfig("rememberme/cookie_expiry"));
                }
                Session::set('firstname', $loggeduser->data['firstname']);
                Session::set('lastname', $loggeduser->data['lastname']);
                Session::set('gender', $loggeduser->data['gender']);

                return true;
            }
        }
        else{
            $this->makeError("account", "Netočan korinički račun ili email adresa.");
        }
    }

    private function usernameexists()
    {
        if(!empty($this->load("users", "username", $this->data["username"])))
        {
            $this->makeError("usernameexists", "Username ". $this->data["username"] . " already exists.");
        }
    }

    private function emailexists()
    {
        if(!empty($this->load("users", "email", $this->data["email"])))
        {
            $this->makeError("emailexists", "Username ". $this->data["email"] . " already exists.");
        }
    }

    private function checkrememberme()
    {
        return $this->load('rememberme', 'user_id', Session::get('id'));
    }

    public static function checkhash($hash)
    {
        return self::static_load('rememberme', 'hash', $hash);
    }

    public static function deletecookie($id)
    {
        self::static_delete('rememberme', 'user_id', $id);
    }

    public function getUserSettings()
    {
        return $this->load("users", "id", Session::get("id"));
    }

    public function getpassword()
    {
        $password = $this->load("users", "id", Session::get("id"), ["password"]);
        return  $password[0]["password"];
    }

    public function updatepassword()
    {

       $check = password_verify($this->data["current_password"], $this->getpassword());

        if(!$check)
        {
            $this->makeError("wrong_password", "Lozinke se ne podudaraju");
        }else{
            $hash = password_hash($this->data['new_password'], PASSWORD_DEFAULT);

            $this->update("users", ["password", "id"], [$hash, Session::get("id")]);
        }
    }
}