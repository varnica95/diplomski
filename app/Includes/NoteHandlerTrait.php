<?php


namespace App\Includes;


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