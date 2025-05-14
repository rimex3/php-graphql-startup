<?php

class Database
{
    private $host = "";
    private $name = "";
    private $password = "";
    private $db_name = "";
    private $port = 3306;

    public $conn;

    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->name, $this->password, $this->db_name, $this->port);

        if ($this->conn->connect_error) {
            die(json_encode([
                "error" => "Connection Failed" . $this->conn->connect_error
            ]));
        }

        return $this->conn;
    }
}