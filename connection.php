<?php

class Connection extends \PDO
{
    private $database;
    private $host;
    private $db;

    public function raw($query)
    {
        $this->prepare($query);
    }
}