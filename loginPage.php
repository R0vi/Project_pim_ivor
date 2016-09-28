<?php

class Login
{
    private $queryBuilder;
    private $db;

    public function __construct(QueryBuilder $queryBuilder, Connection $connection)
    {
        $this->queryBuilder = $queryBuilder;
        $this->db = $connection;

    }

    // returns an array [password] => password
    //                  [username] => username
    public function getLoginPost()
    {
        $userSupliedDetails = array();
        if (!empty($_POST)) {
            if (!empty($_POST['user']))
            {
                $userSupliedDetails['username'] = $_POST['user'];
            }
            if (!empty($_POST['password']))
            {
                $userSupliedDetails['password'] = $_POST['password'];
            }
        }
        return $userSupliedDetails;

    }

    // gets the inlogdetails from the db
    public function getFromDatabase()
    {
        $userInput = $this->getLoginPost();
        $query = $this->db->prepare('SELECT username, password FROM login WHERE :username = username AND :password = password');
        $query->execute(array(':username' => $userInput['username'], ':password' => $userInput['password']));
    }
}

