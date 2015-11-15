<?php

define("MAX_EMAIL_LENGTH", 50);
define("MAX_PASSWORD_LENGTH", 16);
define("MAX_NAME_LENGTH", 50);


//============================================================================= AUTH COMMANDS
function authenticate($email, $password)
{
    $success = false;

    if (!isset($email) || !isset($password))
        return false;

    if (strlen($email) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH)
        return false;

    $connection = get_connection();

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("SELECT id, password_hash FROM users WHERE email=?"))
    {
        if ($statement->bind_param("s", strtolower($email)) && $statement->execute())
        {
            $statement->bind_result($id, $password_hash);

            if ($statement->fetch() && password_verify($password, $password_hash))
            {
                $_SESSION['user_id'] = $id;
                $success = true;
            }
        }
    }

    $connection->close();

    return $success;
}

function logout()
{
    unset($_SESSION['user_id']);
}


function is_authd()
{
    return isset($_SESSION['user_id']);
}


//============================================================================= AUTH INFO
function get_user_id()
{
    return $_SESSION['user_id'];
}

function get_name()
{
    $name = '[NULL]';

    if (!is_authd())
        return $name;

    $connection = get_connection();

    if ($connection->connect_error)
        return $name;

    $result = $connection->query("SELECT name FROM users WHERE id=" . get_user_id());

    if ($row = $result->fetch_assoc())
        $name = $row['name'];

    $connection->close();
    
    return $name;
}


//============================================================================= REGISTRATION
function is_email_exist($email)
{
    $exist = false;

    if (!isset($email) || strlen($email) > MAX_EMAIL_LENGTH)
        return false;

    $connection = get_connection();

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("SELECT * FROM users WHERE email=?"))
    {
        if ($statement->bind_param("s", strtolower($email)) && $statement->execute())
        {
            $statement->store_result();

            if ($statement->fetch())
                $exist = true;
        }
    }

    $connection->close();

    return $exist;
}

function is_email_valid($email)
{
    if (!isset($email)) return false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
    return strlen($email) <= MAX_EMAIL_LENGTH;
}


function register($email, $password, $name)
{
    $success = false;

    $connection = get_connection();

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("INSERT INTO users (email, password_hash, name) VALUES (?, ?, ?)"))
    {
        if ($statement->bind_param("sss", strtolower($email), password_hash($password, PASSWORD_DEFAULT), $name) && $statement->execute())
            $success = true;
    }

    $connection->close();

    return $success;
}


//============================================================================= MISC
function get_connection()
{
    return new mysqli('localhost', 'root', '', 'league');
}

?>
