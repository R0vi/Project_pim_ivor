<?php

class Login
{
    private $username;
    private $password;

    public function __construct()
    {

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
        
    }

    public function validateInput()
    {

    }
}