<?php

include_once('constants.php');
include_once('sql.php');

class Registration
{
    //========================================================================= VARIABLES
    private $username;
    private $email;
    private $password;
    private $retyped_password;

    private $username_err = "";
    private $email_err = "";
    private $password_err = "";
    private $retyped_password_err = "";

    //========================================================================= INITIALIZE
    function __construct($username, $email, $password, $retyped_password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->retyped_password = $retyped_password;
    }

    //========================================================================= FUNCTIONS
    public function try_register()
    {
        if (!$this->validate())
            return false;

        $connection = sql::connection();

        if ($connection->connect_error)
            return false;

        $success = false;
        if ($statement = $connection->prepare("INSERT INTO users (username, email, password_hash, verification_code) VALUES (?, lower(?), ?, ?)"))
        {
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $code = md5(rand(40000, 50000));
            if ($statement->bind_param("ssss", $this->username, $this->email, $hash, $code) && $statement->execute())
                $success = true;
        }

        $connection->close();

        return $success;
    }


    private function validate()
    {
        $valid = true;
        
        if (!$this->is_username_valid())
        {
            $valid = false;
            $this->username_err = 'Username must be between 6 to 16 characters and consist of A-Z a-z 0-9.';
        }
        else if ($this->is_username_exist())
        {
            $valid = false;
            $this->username_err = 'Username already exists.';
        }
        
        if (!$this->is_email_valid())
        {
            $valid = false;
            $this->email_err = 'Email invalid.';
        }
        else if ($this->is_email_exist())
        {
            $valid = false;
            $this->email_err = 'Email already exists.';
        }
        
        if (!$this->is_password_valid())
        {
            $valid = false;
            $this->password_err = 'Password must be between 8 to 16 characters and consist of A-Z a-z 0-9.';
        }
        else if (!$this->is_retyped_password_valid())
        {
            $valid = false;
            $this->retyped_password_err = 'Passwords do not match.';
        }

        return $valid;
    }

    private function is_username_valid()
    {
        if (!isset($this->username)) return false;
        return preg_match("/^[A-Za-z0-9]{6,16}$/", $this->username);
    }

    private function is_email_valid()
    {
        if (!isset($this->email)) return false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;
        return strlen($this->email) <= MAX_EMAIL_LENGTH;
    }

    private function is_password_valid()
    {
        if (!isset($this->password)) return false;
        return preg_match("/^[A-Za-z0-9]{8,16}$/", $this->password);
    }

    private function is_retyped_password_valid()
    {
        if (!isset($this->password) || !isset($this->retyped_password)) return false;
        return $this->password === $this->retyped_password;
    }


    private function is_username_exist()
    {
        $connection = sql::connection();

        if ($connection->connect_error)
            return true;

        $exist = true;
        if ($statement = $connection->prepare("SELECT * FROM users WHERE lower(username)=lower(?)"))
        {
            if ($statement->bind_param("s", $this->username) && $statement->execute())
            {
                $statement->store_result();

                if (!$statement->fetch())
                    $exist = false;
            }
        }

        $connection->close();

        return $exist;
    }

    private function is_email_exist()
    {
        $connection = sql::connection();

        if ($connection->connect_error)
            return true;

        $exist = true;
        if ($statement = $connection->prepare("SELECT * FROM users WHERE lower(email)=lower(?)"))
        {
            if ($statement->bind_param("s", $this->email) && $statement->execute())
            {
                $statement->store_result();

                if (!$statement->fetch())
                    $exist = false;
            }
        }

        $connection->close();

        return $exist;
    }

    //========================================================================= PROPERTIES
    public function username_err()
    {
        return $this->username_err;
    }
    public function email_err()
    {
        return $this->email_err;
    }
    public function password_err()
    {
        return $this->password_err;
    }
    public function retyped_password_err()
    {
        return $this->retyped_password_err;
    }
}

?>