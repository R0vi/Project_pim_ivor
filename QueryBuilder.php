<?php


class QueryBuilder
{
    private $connection;
    private $db;

    public function __construct(Connection $connection)
    {
        $connection = $this->connection;
        $this->db = $connection->db;
    }

    public function selectQuery($table, array $fields, array $data = [])
    {
        $where = '';
        $placeholders = '';
        if(!$data == null)
        {
            $where = ' WHERE';
            $fields = implode($fields,', ');

            $placeholders = array_map(function($key){
                return $key . ' = :' . $key;
            },array_keys($data));

            $placeholders = implode($placeholders,', ');

        }

        $query = $this->db->prepare('SELECT ' . $fields . ' FROM ' . $table . $where . $placeholders);

        foreach($data as $key => &$value){
            $query->bindParam(':' . $key,$value);
        }

        $query->execute();

        return $query->fetch();
    }

    public function insertQuery($table, array $columns, array $values)
    {
        $columns = implode($columns,',');
        $valuesarray = array_map(function($key){
            return ':' . $key;
        },array_keys($values));
        $values = implode($valuesarray,',');

        echo'INSET INTO '.$table.' ('.$columns.') VALUES ('.$values.')';

        $query = $this->db->prepare('INSET INTO ' . $table . ' (' . $columns . ') VALUES (' . $values . ')');

        foreach($valuesarray as $key => &$value){
            $query->bindParam(':' . $key,$value);
        }

        return $query->execute();

    }
}

