<?php

include_once('cls/constants.php');
include_once('cls/sql.php');

//============================================================================= AUTH COMMANDS
function authenticate($username, $password)
{
    $success = false;

    if (!isset($username) || !isset($password))
        return false;

    if (strlen($username) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH)
        return false;

    $connection = sql::connection();

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("SELECT id, password_hash FROM users WHERE lower(username)=lower(?) OR lower(email)=lower(?)"))
    {
        if ($statement->bind_param("ss", $username, $username) && $statement->execute())
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

function get_username()
{
    $name = '[NULL]';

    if (!is_authd())
        return $name;

    $connection = sql::connection();

    if ($connection->connect_error)
        return $name;

    $result = $connection->query("SELECT username FROM users WHERE id=" . get_user_id());

    if ($row = $result->fetch_assoc())
        $name = $row['username'];

    $connection->close();
    
    return $name;
}

?>
