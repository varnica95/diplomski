<?php

namespace App\Core;

use App\Includes\Session;
use PDO;

class Model
{
    public $data = array();

    protected $connection;

    protected static $static_connection;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    protected function loadUserResults($table = "user_table", $field, $value)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT id, ckd, ckd_note, created FROM {$table} WHERE {$field} = '{$value}' ORDER BY created DESC";

            $row = $this->connection->query($sql);
            $row->setFetchMode(PDO::FETCH_ASSOC);

            return $row->fetchAll();
        }catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }

    protected function load($table, $field, $value)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();
            if($table === "user_table") {
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = $this->connection->query($sql);
                $row->setFetchMode(PDO::FETCH_ASSOC);

                return $row->fetchAll();
            }
            else{
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = $this->connection->query($sql);
                $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

                return $row->fetch();
            }
        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected static function static_load($table, $field, $value)
    {
        try{
            self::$static_connection= Database::getInstance()->getConnection();
            if($table === "user_table") {
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = self::$static_connection->query($sql);
                $row->setFetchMode(PDO::FETCH_ASSOC);

                return $row->fetchAll();
            }
            else{
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = self::$static_connection->query($sql);
                $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

                return $row->fetch();
            }
        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected function insert($table, array $data)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            if($table == "users") {
                unset($data["signup-submit"]);
                unset($data["password-again"]);

                $fields = implode(", ", array_keys($data));

                $values = explode(",", (":" . implode(",:", array_keys($data))));
                $values = implode(", ", $values);

                $sql = "INSERT INTO {$table} (" . $fields . ", joined) VALUES (" . $values . ", :joined)";

                $stmt = $this->connection->prepare($sql);

                foreach ($data as $key => $value)
                {
                        $stmt->bindValue(":" . $key, $value);
                }

                $stmt->bindValue(':joined', date("Y-m-d H:i:s"));
            }

            if($table == "rememberme")
            {
                $fields = implode(", ", array_keys($data));

                $values = explode(",", (":" . implode(",:", array_keys($data))));
                $values = implode(", ", $values);

                $sql = "INSERT INTO {$table} (" . $fields . ") VALUES (" . $values . ")";
                $stmt = $this->connection->prepare($sql);

                foreach ($data as $key => $value)
                {
                    $stmt->bindValue(":" . $key, $value);
                }
            }

            if($table == "user_table")
            {
                $sql = "INSERT INTO user_table (user_id, bp_sys, bp_dia, sg, su, rbc, bu, sc, sod, pot, hemo, wbcc, rbcc, ckd, bp_note, sg_note, su_note, rbc_note, bu_note, sc_note, sod_note, pot_note, hemo_note, wbcc_note, rbcc_note, ckd_note, created) 
                        VALUES (:user_id, :bp_sys, :bp_dia, :sg, :su, :rbc, :bu, :sc, :sod, :pot, :hemo, :wbcc, :rbcc, :ckd, :bp_note, :sg_note, :su_note, :rbc_note, :bu_note, :sc_note, :sod_note, :pot_note, :hemo_note, :wbcc_note, :rbcc_note, :ckd_note, :created)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":user_id", Session::get("id"));
                $stmt->bindValue(":bp_sys", $data[0]);
                $stmt->bindValue(":bp_dia",  $data[1]);
                $stmt->bindValue(":sg",  $data[2]);
                $stmt->bindValue(":su",  $data[3]);
                $stmt->bindValue(":rbc",  $data[4]);
                $stmt->bindValue(":bu",  $data[5]);
                $stmt->bindValue(":sc",  $data[6]);
                $stmt->bindValue(":sod",  $data[7]);
                $stmt->bindValue(":pot",  $data[8]);
                $stmt->bindValue(":hemo",  $data[9]);
                $stmt->bindValue(":wbcc",  $data[10]);
                $stmt->bindValue(":rbcc",  $data[11]);
                $stmt->bindValue(":ckd",  $data[12]);
                $stmt->bindValue(":bp_note", $data[13][0]);
                $stmt->bindValue(":sg_note",  $data[13][1]);
                $stmt->bindValue(":su_note",  $data[13][2]);
                $stmt->bindValue(":rbc_note",  $data[13][3]);
                $stmt->bindValue(":bu_note",  $data[13][4]);
                $stmt->bindValue(":sc_note",  $data[13][5]);
                $stmt->bindValue(":sod_note",  $data[13][6]);
                $stmt->bindValue(":pot_note",  $data[13][7]);
                $stmt->bindValue(":hemo_note",  $data[13][8]);
                $stmt->bindValue(":wbcc_note",  $data[13][9]);
                $stmt->bindValue(":rbcc_note",  $data[13][10]);
                $stmt->bindValue(":ckd_note",  $data[13][11]);
                $stmt->bindValue(':created', date("Y-m-d H:i:s"));
            }

            $stmt->execute();

        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected function delete($table, $field, $value)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            $sql = "DELETE FROM {$table} WHERE {$field} = {$value}";

            $row = $this->conn->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();

        }catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }

    public static function static_delete($tableName, $field, $value)
    {
        try {
            self::$static_connection = Database::getInstance()->getConnection();
            $sql = "DELETE FROM {$tableName} WHERE {$field} = '{$value}'";

            $row = self::$static_connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        }
        catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }

    protected function loaduser($table, $fields, $values)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT * FROM {$table} WHERE {$fields[0]} = '{$values[0]}' OR {$fields[1]} = '{$values[1]}'";
            $row = $this->connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        }catch(\PDOException $e)
        {
            $e->getMessage();
        }
    }

    protected function getNoteFromTable($value)
    {
        try {
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT note FROM parameters_notes WHERE parameter_class = '{$value}'";

            $row = $this->connection->query($sql);

            $row->setFetchMode(PDO::FETCH_ASSOC);

            return $row->fetch();
        }catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }
}