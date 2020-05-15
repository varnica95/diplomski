<?php

namespace App\Includes;

class Validation
{
    use ErrorHandlerTrait;

    private $_errors = [];

    private $_data = [];

    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            if ($key !== "signup-submit") {
                $this->_data[$key] = $value;
            }

        }

        $this->validate();
    }

    public function emptyfields()
    {
        foreach ($this->_data as $key => $value) {
            if (empty($value)) {
                if ($key === "gender")
                    $this->makeError("gender", "Molimo popunite sva prazna polja.");

                $this->makeError("empty", "Molimo popunite sva prazna polja.");
            }
        }
    }

    public function name()
    {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $this->_data["firstname"])) {
            $this->makeError("firstname", "Uneseno ime " . $this->_data["firstname"] . " nije važeče.");
        }

        if (!preg_match("/^([a-zA-Z' ]+)$/", $this->_data["lastname"])) {
            $this->makeError("lastname", "Uneseno prezime " . $this->_data["lastname"] . " nije važeće.");
        }
    }

    public function username()
    {
        if (strlen($this->_data["username"]) < 5) {
            $this->makeError("username", "Duljina korisničkog imena ne može biti manja od 5.");
        } else if (!preg_match("/^([a-zA-Z0-9' ]+)$/", $this->_data["username"])) {
            $this->makeError("username", "Korinsničko ime mora sadržavati samo slova i brojeve.");
        }
    }

    public function email()
    {
        if (!filter_var($this->_data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->makeError("email", "Email adresa " . $this->_data["email"] . " nije važeća.");
        }
    }

    public function password()
    {
        if (strlen($this->_data["password"]) < 5) {
            $this->makeError("password", "Duljina lozinke ne može biti manja od 5.");
        } else if (!preg_match("#[0-9]+#", $this->_data["password"])) {
            $this->makeError('password', 'Lozinka mora sadržavati broj.');
        } else if (!preg_match("#[A-Z]+#", $this->_data["password"])) {
            $this->makeError('password', 'Lozinka mora sadržavati veliko slovo.');
        } else if ($this->_data["password"] !== $this->_data["password-again"]) {
            $this->makeError('password', 'Unesene lozinke se ne podudaraju.');
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