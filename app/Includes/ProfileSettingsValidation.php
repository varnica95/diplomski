<?php


namespace App\Includes;


class ProfileSettingsValidation
{
    use ErrorHandlerTrait;

    private $_data = [];

    private $_errors = [];

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            if ($key === "current_password" || $key === "new_password" || $key === "repeat_password") {
                $this->_data[$key] = $value;
            }
        }

        $this->validate();
    }

    protected function emptyfields()
    {
        foreach ($this->_data as $key => $value) {
            if (empty($value)) {
                $this->makeError("empty", "Molimo popunite sva prazna polja.");
            }
        }
    }

    public function password()
    {
        if (strlen($this->_data["new_password"]) < 5) {
            $this->makeError("password", "Duljina lozinke ne može biti manja od 5.");
        } else if (!preg_match("#[0-9]+#", $this->_data["new_password"])) {
            $this->makeError('password', 'Lozinka mora sadržavati broj.');
        } else if (!preg_match("#[A-Z]+#", $this->_data["new_password"])) {
            $this->makeError('password', 'Lozinka mora sadržavati veliko slovo.');
        } else if ($this->_data["current_password"] !== $this->_data["repeat_password"]) {
            $this->makeError('password', 'Unesene lozinke se ne podudaraju.');
        }
    }

     protected function validate()
     {
      $this->emptyfields();
      $this->password();
     }

}