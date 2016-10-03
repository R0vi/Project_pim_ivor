<?php

class Login
{
    private $queryBuilder;
    private $db;

    public function __construct(QueryBuilder $queryBuilder, Connection $connection)
    {
        $this->queryBuilder = $queryBuilder;
        $this->db = $connection;
        echo "contructor";
    }

    // returns an array [password] => password
    //                  [username] => username
    public function getLoginPost()
    {
        echo "getloginPost";
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
        echo "getfromdatabase";
        $userInput = $this->getLoginPost();
        $query = $this->db->prepare('SELECT username, password , usertype FROM login WHERE :username = username AND :password = password');
        $query->execute(array(':username' => $userInput['username'], ':password' => $userInput['password']));
        $result = $query->fetch();
        return $result;
    }

    public function storeLogin($data)
    {
        $_SESSION['login'] = $data;
        header('location: http://localhost/Project_pim_ivor/mainPage.php');
    }
}

