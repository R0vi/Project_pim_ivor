<?php

class QueryBuilder
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $connection = $this->connection;
    }

    public function selectQuery($table, $data)
    {
        
    }
}