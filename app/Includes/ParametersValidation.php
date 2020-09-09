<?php


namespace App\Includes;


class ParametersValidation
{
    use ErrorHandlerTrait;

    private $_data = [];

    private $_errors = [];


    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->_data[$key] = $value;
        }

        $this->validate();
    }

    private function emptyfields()
    {
        foreach ($this->_data as $key => $value) {

            if ($key !== "check-submit") {
                if (!is_numeric($value)) {
                    $this->makeError($key, "Polja ne smiju biti prazna.");
                }
            }
        }
    }

    private function onlynumber()
    {
        foreach ($this->_data as $key => $value) {
            if ($key !== "check-submit") {
                if ($key === "sg") {
                    if (!strpos($value, ".")) {
                        $this->makeError($key . "-notfloat", "Polje mora biti decimalni broj.");
                    }
                } else {
                    if (!is_numeric($value))
                        $this->makeError($key . "-notnumber", "Polje mora biti broj.");
                }
            }
        }
    }

    private function validate()
    {
        $this->emptyfields();
        $this->onlynumber();
    }
}