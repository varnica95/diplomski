<?php

namespace App\Core;

use App\Includes\Session;
use PDO;

class Model
{
    protected static $static_connection;
    public $data = array();
    protected $connection;

    public static function static_delete($tableName, $field, $value)
    {
        try {
            self::$static_connection = Database::getInstance()->getConnection();
            $sql = "DELETE FROM {$tableName} WHERE {$field} = '{$value}' LIMIT 1";

            $row = self::$static_connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected static function static_load($table, $field, $value)
    {

        try {
            self::$static_connection = Database::getInstance()->getConnection();
            if ($table === "details_table") {

                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";
                $row = self::$static_connection->query($sql);
                $row->setFetchMode(PDO::FETCH_ASSOC);

                return $row->fetchAll();
            } else {
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = self::$static_connection->query($sql);
                $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

                return $row->fetch();
            }
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    protected function load($table, $field, $value, array $columns = [])
    {
        try {
            $this->connection = Database::getInstance()->getConnection();
            if (!empty($columns)) {
                $fields = implode(", ", $columns);
                $sql = "SELECT {$fields} FROM {$table} WHERE {$field} = '{$value}'";

                $row = $this->connection->query($sql);
                $row->setFetchMode(PDO::FETCH_ASSOC);

                return $row->fetchAll();
            }
            if ($table === "details_table") {
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = $this->connection->query($sql);
                $row->setFetchMode(PDO::FETCH_ASSOC);

                return $row->fetchAll();
            } else {
                $sql = "SELECT * FROM {$table} WHERE {$field} = '{$value}'";

                $row = $this->connection->query($sql);
                $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

                return $row->fetch();
            }
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected function insert($table, array $data)
    {
        try {
            $this->connection = Database::getInstance()->getConnection();

            if ($table == "users") {
                unset($data["signup-submit"]);
                unset($data["password-again"]);

                $fields = implode(", ", array_keys($data));

                $values = explode(",", (":" . implode(",:", array_keys($data))));
                $values = implode(", ", $values);
                $age = (int)((time()- strtotime($data["birthdate"])) / (3600 * 24 * 365));
                $sql = "INSERT INTO {$table} (" . $fields . ", joined, age) VALUES (" . $values . ", :joined, :age)";

                $stmt = $this->connection->prepare($sql);

                foreach ($data as $key => $value) {
                    $stmt->bindValue(":" . $key, $value);
                }

                $stmt->bindValue(":joined", date("Y-m-d H:i:s"));
                $stmt->bindValue(":age", $age);

            }

            if ($table == "rememberme") {
                $fields = implode(", ", array_keys($data));

                $values = explode(",", (":" . implode(",:", array_keys($data))));
                $values = implode(", ", $values);

                $sql = "INSERT INTO {$table} (" . $fields . ") VALUES (" . $values . ")";
                $stmt = $this->connection->prepare($sql);

                foreach ($data as $key => $value) {
                    $stmt->bindValue(":" . $key, $value);
                }
            }

            if ($table == "details_table") {
                $sql = "INSERT INTO details_table (user_id, bp_sys, bp_dia, sg, al, alsc_ratio, su, rbc, bu, sc, sod, pot, hemo, wbcc, rbcc, ckd, ckdprecision, bun_sc_ratio, crcl, gfr, bp_note, rbc_note, hemo_note, su_note, bu_note, sc_note, sod_note, pot_note, sg_note, al_note, wbcc_note, rbcc_note, ckd_note, bun_sc_ratio_note, crcl_note, crcl_anem_note, gfr_note, created) 
                        VALUES (:user_id, :bp_sys, :bp_dia, :sg, :al, :alsc_ratio, :su, :rbc, :bu, :sc, :sod, :pot, :hemo, :wbcc, :rbcc, :ckd, :ckdprecision, :bun_sc_ratio, :crcl, :gfr, :bp_note, :rbc_note, :hemo_note, :su_note, :bu_note, :sc_note, :sod_note, :pot_note, :sg_note, :al_note, :wbcc_note, :rbcc_note, :ckd_note, :bun_sc_ratio_note, :crcl_note, :crcl_anem_note, :gfr_note, :created)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":user_id", Session::get("id"));
                $stmt->bindValue(":bp_sys", $data[0]);
                $stmt->bindValue(":bp_dia", $data[1]);
                $stmt->bindValue(":sg", $data[2]);
                $stmt->bindValue(":al", $data[3]);
                $stmt->bindValue(":alsc_ratio", $data[4]);
                $stmt->bindValue(":su", $data[5]);
                $stmt->bindValue(":rbc", $data[6]);
                $stmt->bindValue(":bu", $data[7]);
                $stmt->bindValue(":sc", $data[8]);
                $stmt->bindValue(":sod", $data[9]);
                $stmt->bindValue(":pot", $data[10]);
                $stmt->bindValue(":hemo", $data[11]);
                $stmt->bindValue(":wbcc", $data[12]);
                $stmt->bindValue(":rbcc", $data[13]);
                $stmt->bindValue(":ckd", $data[14]);
                $stmt->bindValue(":ckdprecision", $data[15]);
                $stmt->bindValue(":bun_sc_ratio", $data[16]);
                $stmt->bindValue(":crcl", $data[17]);
                $stmt->bindValue(":gfr", $data[18]);
                $stmt->bindValue(":bp_note", $data[19][0]);
                $stmt->bindValue(":rbc_note", $data[19][1]);
                $stmt->bindValue(":hemo_note", $data[19][2]);
                $stmt->bindValue(":su_note", $data[19][3]);
                $stmt->bindValue(":bu_note", $data[19][4]);
                $stmt->bindValue(":sc_note", $data[19][5]);
                $stmt->bindValue(":sod_note", $data[19][6]);
                $stmt->bindValue(":pot_note", $data[19][7]);
                $stmt->bindValue(":sg_note", $data[19][8]);
                $stmt->bindValue(":al_note", $data[19][9]);
                $stmt->bindValue(":rbcc_note", $data[19][10]);
                $stmt->bindValue(":wbcc_note", $data[19][11]);
                $stmt->bindValue(":ckd_note", $data[19][16]);
                $stmt->bindValue(":bun_sc_ratio_note", $data[19][12]);
                $stmt->bindValue(":crcl_note", $data[19][14]);
                $stmt->bindValue(":crcl_anem_note", $data[19][13]);
                $stmt->bindValue(":gfr_note", $data[19][15]);
                $stmt->bindValue(':created', date("Y-m-d H:i:s"));
            }

            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected static function delete($table, $field, $value)
    {
        try {
            self::$static_connection = Database::getInstance()->getConnection();

            $sql = "DELETE FROM {$table} WHERE {$field} = {$value}";

            $row = self::$static_connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();

        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected function loaduser($table, $fields, $values)
    {
        try {
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT * FROM {$table} WHERE {$fields[0]} = '{$values[0]}' OR {$fields[1]} = '{$values[1]}'";
            $row = $this->connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    protected function getNoteFromTable($value)
    {
        try {
            $this->connection = Database::getInstance()->getConnection();

            $sql = "SELECT note FROM notes WHERE class = '{$value}'";

            $row = $this->connection->query($sql);

            $row->setFetchMode(PDO::FETCH_ASSOC);

            return $row->fetch();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function update($table, $fields = [], $values = [])
    {
        try {
            $this->connection = Database::getInstance()->getConnection();

            $sql = "UPDATE {$table} SET {$fields[0]} = '{$values[0]}' WHERE {$fields[1]} = '{$values[1]}'";

            $row = $this->connection->query($sql);

            $row->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

            return $row->fetch();
        }
        catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }
}