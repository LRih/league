<?php

include_once('cls/constants.php');
include_once('cls/sql.php');

function authenticate($username, $password)
{
    if (!isset($username) || !isset($password))
        return false;

    if (strlen($username) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH)
        return false;

    $connection = SQL::connection();

    if ($connection->connect_error)
        return false;

    $success = false;
    if ($statement = $connection->prepare("SELECT id, password_hash FROM users WHERE lower(username)=lower(?) OR lower(email)=lower(?)"))
    {
        if ($statement->bind_param("ss", $username, $username) && $statement->execute())
        {
            $statement->bind_result($id, $password_hash);

            if ($statement->fetch() && password_verify($password, $password_hash))
            {
                $_SESSION['user'] = new Account($id);
                $success = true;
            }
        }
    }

    $connection->close();

    return $success;
}

function logout()
{
    unset($_SESSION['user']);
}


function is_authd()
{
    return isset($_SESSION['user']);
}

function get_account()
{
    return $_SESSION['user'];
}

?>
