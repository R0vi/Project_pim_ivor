<?php

class Connection
{
    private $db;
    public function __construct($host = 'localhost', $database, $username, $password)
    {
        $this->db = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
        session_start();
    }

    public function getDb()
    {
        return $this->db;
    }
}