<?php

include_once('constants.php');
include_once('sql.php');

class PasswordChange
{
    //========================================================================= VARIABLES
    private $account;
    private $cur_password;
    private $new_password;
    private $retyped_password;

    private $cur_password_err = "";
    private $new_password_err = "";
    private $retyped_password_err = "";

    //========================================================================= INITIALIZE
    function __construct($account, $cur_password, $new_password, $retyped_password)
    {
        $this->account = $account;
        $this->cur_password = $cur_password;
        $this->new_password = $new_password;
        $this->retyped_password = $retyped_password;
    }

    //========================================================================= FUNCTIONS
    public function try_change()
    {
        if (!$this->validate())
            return false;

        $connection = sql::connection();

        if ($connection->connect_error)
            return false;

        $success = false;
        if ($statement = $connection->prepare("UPDATE users SET password_hash=? WHERE id=?"))
        {
            $hash = password_hash($this->new_password, PASSWORD_DEFAULT);
            if ($statement->bind_param("si", $hash, $this->account->id()) && $statement->execute())
                $success = true;
        }

        $connection->close();

        return $success;
    }


    private function validate()
    {
        $valid = true;
        
        if (!$this->is_cur_password_match())
        {
            $valid = false;
            $this->cur_password_err = 'Current password is incorrect.';
        }
        
        if (!$this->is_new_password_valid())
        {
            $valid = false;
            $this->new_password_err = 'Password must be between 8 to 16 characters and consist of A-Z a-z 0-9.';
        }
        else if (!$this->is_retyped_password_valid())
        {
            $valid = false;
            $this->retyped_password_err = 'Passwords do not match.';
        }

        return $valid;
    }

    private function is_cur_password_match()
    {
        if (!isset($this->cur_password)) return false;
        if (strlen($this->cur_password) > MAX_PASSWORD_LENGTH) return false;
        return password_verify($this->cur_password, $this->account->password_hash());
    }

    private function is_new_password_valid()
    {
        if (!isset($this->new_password)) return false;
        return preg_match("/^[A-Za-z0-9]{8,16}$/", $this->new_password);
    }

    private function is_retyped_password_valid()
    {
        if (!isset($this->new_password) || !isset($this->retyped_password)) return false;
        return $this->new_password === $this->retyped_password;
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
    public function cur_password_err()
    {
        return $this->cur_password_err;
    }
    public function new_password_err()
    {
        return $this->new_password_err;
    }
    public function retyped_password_err()
    {
        return $this->retyped_password_err;
    }
}

?>