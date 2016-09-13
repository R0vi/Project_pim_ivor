<?php

class connect
{
    private $database;
    private $host;
    private $db;
    
    public function __construct($database, $host = 'localhost')
    {
        $database = $this->database;
        $host = $this->host;
    }

    public function connect($username, $password)
    {
        try {
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $username, $password);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}