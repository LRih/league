<?php include_once('php/global.php') ?>

<?php

include_once('php/auth.php');
include_once('php/cls/sql.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
    </head>
    <body>
        <?php
            draw_header("AUTH TEST");
            echo "Logged in user: " . (is_authd() ? get_account()->username() : '[NULL]') . "<br>";

            draw_header("SQL TEST");
            $connection = sql::connection();

            if ($connection->connect_error)
                die("Connection to league failed: " . $connection->connect_error);

            echo "Connected to league successfully<br><br>";

            $result = $connection->query("SELECT * FROM users");

            echo " ID : USERNAME : EMAIL : PASSWORD_HASH<br>";
            echo "---------------------------------------<br>";
            while($row = $result->fetch_assoc())
                echo $row["id"] . " : " . $row["username"] . " : " . $row["email"] . " : " . $row["password_hash"] . "<br>";

            $connection->close();

            function draw_header($str)
            {
                echo "<br><br> " . $str . "<br>";
                for ($i = 0; $i < strlen($str) + 2; $i++)
                    echo "=";
                echo "<br>";
            }
        ?>
    </body>
</html>
