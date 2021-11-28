<?php 

namespace App;

class DatabaseClass{
    
    private $host;
    private $userName;
    private $password;
    private $database;

    protected function connection()
    {
        $this->host = "zoom_app_db";
        $this->userName = "root";
        $this->password = "secret";
        $this->database = "zoom_db";
        $conn = new \mysqli($this->host,$this->userName,$this->password,$this->database);

        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            return $conn;
        }
    }
}