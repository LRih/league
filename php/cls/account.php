<?php

include_once('sql.php');

class Account
{
    //========================================================================= VARIABLES
    private $id;
    private $username;
    private $email;
    private $is_verified;

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

        if ($result = $connection->query("SELECT * FROM users WHERE id=" . $this->id))
        {
            if ($row = $result->fetch_assoc())
            {
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->is_verified = $row['is_verified'];
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

    function is_verified()
    {
        return $this->is_verified;
    }
    function verification_code()
    {
        $connection = SQL::connection();

        if ($connection->connect_error)
            return;

        $verification_code = '';
        if ($result = $connection->query("SELECT verification_code FROM users WHERE id=" . $this->id))
        {
            if ($row = $result->fetch_assoc())
                $verification_code = $row['verification_code'];
        }

        $connection->close();

        return $verification_code;
    }
}

?>