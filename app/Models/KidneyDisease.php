<?php


namespace App\Models;


use App\Core\Model;
use App\Includes\NoteHandlerTrait;
use App\Includes\ParametersHandlerTrait;

class KidneyDisease extends Model
{
    use NoteHandlerTrait;
    use ParametersHandlerTrait;

    private $_note = array();

    public function __construct(array $params = [])
    {
       foreach ($params as $key => $value)
       {
           $this->$key = $value;
       }
    }

    public function generateDisease()
    {
       $hypertension = $this->bloodPressureHandler($this->data["bp-sys"], $this->data["bp-dia"]);

       return $hypertension;
    }

    protected function getNote($name)
    {
        return $this->getNoteFromTable($name);
    }

}