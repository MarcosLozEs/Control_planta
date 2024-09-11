<?php

class baseDades
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "1234";
    private $dbname = "controlplanta";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Fallo conexión: " . $this->conn->connect_error);
        }
    }

    public function cerrar_conexion()
    {
        $this->conn->close();
    }
}
