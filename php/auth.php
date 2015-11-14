<?php

function is_valid($email, $password)
{
    $valid = false;

    if (!isset($email) || !isset($password))
        return false;

    $connection = new mysqli('localhost', 'root', '', 'league');

    if ($connection->connect_error)
        return false;

    if ($statement = $connection->prepare("SELECT password_hash FROM users WHERE email=?"))
    {
        if ($statement->bind_param("s", $email) && $statement->execute())
        {
            $statement->bind_result($password_hash);

            if ($statement->fetch() && password_verify($password, $password_hash))
                $valid = true;
        }
    }

    $connection->close();

    return $valid;
}

?>
