<?php

class Database {
    public $host = DB_HOST;
    public $username = DB_USERNAME;
    public $password = DB_PASSWORD;
    public $db_name = DB_NAME;

    public $link;
    public $error;

    public function __construct() {
        // call connect
        $this->connect();
    }

    private function connect() {
        $this->link = new mysql($this->host,$this->username,$this->password,$this->db_name);

        if(!$this->link) {
            $this->error = "Connection error".$this->link->connect_error;
            return false;
        }
    }

    public function select($query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

        if($insert_row) {
            header ('Location: index.php');
        }
    }
}