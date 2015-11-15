<?php

define("MAX_EMAIL_LENGTH", 50);
define("MAX_USERNAME_LENGTH", 16);
define("MAX_PASSWORD_LENGTH", 16);

function authenticate($email, $password)
{
    $valid = false;

    if (!isset($email) || !isset($password))
        return false;

    if (strlen($email) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH)
        return false;

    $connection = get_connection();

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("SELECT id, password_hash FROM users WHERE email=?"))
    {
        if ($statement->bind_param("s", $email) && $statement->execute())
        {
            $statement->bind_result($id, $password_hash);

            if ($statement->fetch() && password_verify($password, $password_hash))
            {
                $_SESSION['user_id'] = $id;
                $valid = true;
            }
        }
    }

    $connection->close();

    return $valid;
}

function is_authd()
{
    return isset($_SESSION['user_id']);
}

function get_username($id)
{
    $name = '<NULL>';
    $connection = get_connection();

    if ($connection->connect_error)
        return false;

    $result = $connection->query("SELECT username FROM users WHERE id=" . $id);

    if ($row = $result->fetch_assoc())
        $name = $row['username'];

    $connection->close();
    
    return $name;
}


function get_connection()
{
    return new mysqli('localhost', 'root', '', 'league');
}

?>
