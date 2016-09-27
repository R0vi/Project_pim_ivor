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
            $where = ' where';
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
        $fields = implode($columns,',');


        $placeholders = array_map(function($key){
            return ':' . $key;
        },array_keys($values));

        echo'INSET INTO '.$table.' FROM '.$table.' WHERE '.$values.$placeholders;

        $placeholders = implode($placeholders,',');

        $query = $this->db->prepare('select ' . $fields . ' where ' . $placeholders);

        foreach($values as $key => &$value){
            $query->bindParam(':' . $key,$value);
        }

        return $query->execute();

    }
}

