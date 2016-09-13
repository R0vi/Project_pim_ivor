<?php

class login
{
    private $username;
    private $password;

    public function __construct()
    {

    }

    public function getLoginPost()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['username']))
            {
                $this->username = $_POST['username'];
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