<?php

include_once('sql.php');

class Account
{
    //========================================================================= VARIABLES
    private $id;
    private $username;
    private $email;

    //========================================================================= INITIALIZE
    function __construct($id)
    {
        $this->id = $id;
        $this->init_data();
    }

    function init_data()
    {
        $this->username = '[NULL]';
        $this->email = '[NULL]';

        $connection = SQL::connection();

        if ($connection->connect_error)
            return;

        if ($result = $connection->query("SELECT username, email FROM users WHERE id=" . $this->id))
        {
            if ($row = $result->fetch_assoc())
            {
                $this->username = $row['username'];
                $this->email = $row['email'];
            }
        }

        $connection->close();
    }

    //========================================================================= PROPERTIES
    function id()
    {
        return $this->id;
    }
    function username()
    {
        return $this->username;
    }
    function email()
    {
        return $this->email;
    }
    function password_hash()
    {
        $connection = SQL::connection();

        if ($connection->connect_error)
            return;

        $password_hash = '';
        if ($result = $connection->query("SELECT password_hash FROM users WHERE id=" . $this->id))
        {
            if ($row = $result->fetch_assoc())
                $password_hash = $row['password_hash'];
        }

        $connection->close();

        return $password_hash;
    }
}

?>