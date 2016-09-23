<?php

class Login
{
    private $username;
    private $password;
    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->$queryBuilder = $queryBuilder;

    }

    public function getLoginPost()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['user']))
            {
                $this->username = $_POST['user'];
            }
            if (!empty($_POST['password']))
            {
                $this->password = $_POST['password'];
            }
        }

    }

    public function getFromDatabase()
    {
        $search = array("user","password");
        $what = array('username' => $this->username);
        $result = $this->queryBuilder->selectQuery("login",$search,$what);
    }

    public function validateInput()
    {

    }
}

