<?php

namespace App\Core;

use PDO;

class Model
{
    public $data = array();

    protected $connection;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    protected function loadfromtable($tablename, $field, $value)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT * FROM {$tablename} WHERE {$field} = '{$value}'";

            $row = $this->connection->query($sql);
            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function insert($tablename, array $data)
    {
        try{
            $this->connection = Database::getInstance()->getConnection();

            if($tablename == "users") {
                unset($data["signup-submit"]);
                unset($data["password-again"]);

                $fields = implode(", ", array_keys($data));
                var_dump($fields);
                $values = explode(",", (":" . implode(",:", array_keys($data))));
                $values = implode(", ", $values);

                $sql = "INSERT INTO {$tablename} (" . $fields . ", joined) VALUES (" . $values . ", :joined)";
                var_dump($sql);
                $stmt = $this->connection->prepare($sql);

                foreach ($data as $key => $value)
                {
                    $stmt->bindValue(":".$key , $value);
                    var_dump($key, $value);

                }

                $stmt->bindValue(':joined', date("Y-m-d H:i:s"));
            }

            $stmt->execute();

        }catch (\PDOException $e) {
            $e->getMessage();
        }
    }
}