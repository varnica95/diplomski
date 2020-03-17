<?php

namespace App\Core;

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

    protected function load($table, $field, $value)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";
            var_dump($sql);
            $row = $this->connection->query($sql);
            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected static function static_load($table, $field, $value)
    {
        try{
            self::$static_connection = Database::getInstance()->getConnection();

            $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";
            var_dump($sql);
            $row = self::$static_connection->query($sql);
            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
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
}