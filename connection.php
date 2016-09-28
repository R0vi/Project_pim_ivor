<?php

class Connection
{
    public function __construct($host = 'localhost', $database, $username, $password)
    {
        return new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
    }
}