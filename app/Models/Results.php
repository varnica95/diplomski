<?php


namespace App\Models;

use App\Core\Model;

class Results extends Model
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserResults()
    {
       return $this->loadUserResults("details_table", "user_id", $this->user_id);
    }

    public static function loadDetails($id)
    {
        return self::static_load("details_table", "id", $id);
    }
}