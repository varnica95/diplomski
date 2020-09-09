<?php


namespace App\Includes;


trait ErrorHandlerTrait
{
    public function getError()
    {
        return $this->_errors;
    }

    public function isPassed()
    {
        return empty($this->_errors);
    }

    public function makeError($errorkey, $desc)
    {
        $this->_errors[$errorkey] = $desc;
    }
}