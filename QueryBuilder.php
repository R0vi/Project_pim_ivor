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

        $query = $this->db->prepare('select ' . $fields . ' FROM ' . $table . $where . $placeholders);

        foreach($data as $key => &$value){
            $query->bindParam(':' . $key,$value);
        }

        return $query->execute();

    }

    public function instertQuery($table, array $fields, array $data = [])
    {
        $fields = implode($fields,',');
        $values = array_values($data);

        $placeholders = array_map(function($key){
            return $key . '=:' . $key;
        },array_keys($data));

        echo'SELECT '.$fields.' FROM '.$table.' WHERE '.$values.$placeholders;

        $placeholders = implode($placeholders,',');

        $query = $this->db->prepare('select ' . $fields . ' where ' . $placeholders);

        foreach($data as $key => &$value){
            $query->bindParam(':' . $key,$value);
        }

        return $query->execute();

    }
}

