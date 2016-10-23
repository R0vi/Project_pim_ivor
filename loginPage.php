<?php

class Login
{
    private $db;
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->db = $this->connection->getDb();
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
    public function validateLogin()
    {
        $userInput = $this->getLoginPost();
        $query = $this->db->prepare('SELECT username, password , usertype FROM login WHERE :username = username AND :password = password');
        $query->execute(array(':username' => $userInput['username'], ':password' => $userInput['password']));
        $result = $query->fetch();
        if($result)
        {
            echo'login succesfull';
            return $result;
        } else {
            echo'login unsuccsesfull';
            return null;
        }
    }

    // stores login data in the session.

    public function storeLogin($data)
    {
        $_SESSION['login'] = $data;
        if(!empty($_SESSION))
        {
            header('Location: mainPage.php');
        }
    }
}

