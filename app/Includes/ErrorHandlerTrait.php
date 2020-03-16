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
        if(empty($this->_errors))
        {
            return true;
        }

        return false;
    }

    public function makeError($errorkey, $desc)
    {
        $this->_errors[$errorkey] = $desc;
    }
}