<?php

class Connection
{
    private $database;
    private $host;
    private $db;

    public function __construct($host = 'localhost', $database)
    {
        $this->database = $database;
        $this->host = $host;
    }

    public function connection($username, $password)
    {
        $this->dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $username, $password);
    }
}