<?php


namespace App\Includes;

use App\Core\Model;

trait NoteHandlerTrait
{
    public function writeNote($key, $value)
    {
        $this->_note[$key] = $value;
    }

    public function getNotes()
    {
        return $this->_note;
    }
}