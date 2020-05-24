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
       return $this->load("details_table", "user_id", $this->user_id, ["id", "ckd", "ckdprecision", "created"]);
    }

    public static function loadDetails($id)
    {
        return self::static_load("details_table", "id", $id);
    }

    public static function sdelete($id)
    {
        Model::static_delete("details_table", "id", $id);
    }
}