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

    // returns an array [password] => password
    //                  [username] => username
    public function getLoginPost()
    {
        $userSupliedDetails = array();
        if (!empty($_POST)) {
            if (!empty($_POST['user']))
            {
                $this->username = $_POST['user'];
                $userSupliedDetails["password"] = $this->password;
            }
            if (!empty($_POST['password']))
            {
                $this->password = $_POST['password'];
                $userSupliedDetails["username"] = $this->username;
            }
        }
        return $userSupliedDetails;

    }

    // gets the inlogdetails from the db
    public function getFromDatabase()
    {
        $search = array("user","password");
        $what = array('username' => $this->username);
        $result = $this->queryBuilder->selectQuery("login",$search,$what);
    }

    // validates if a login attempt is valid
    public function validateInput()
    {
        $userSuplied    = $this->getLoginPost();
        $serverSuplied  = $this->getFromDatabase();

        if( $userSuplied["username"] == $serverSuplied["username"] && $userSuplied["password"] == $serverSuplied["password"] ){
            $_SESSION["loggedIn"] == true;
        }



    }
}

