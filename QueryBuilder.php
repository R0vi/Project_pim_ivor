<?php

class QueryBuilder
{
    private $connection;
    private $db;

    public function __construct(Connection $connection)
    {
        $connection = $this->connection;
        $this->db = $this->connection->db;
    }

    public function selectQuery($table, $data, $where = '')
    {
        $whereTag = 'WHERE';
        if ($where == '')
        {
            $whereTag == '';
        }
        $this->db->prepare('SELECT '.$data.'FROM '.$table.' '.$whereTag.' '.$where.';');
    }
}