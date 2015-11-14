<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php
            $connection = new mysqli('localhost', 'root', '', 'league');

            if ($connection->connect_error)
                die("Connection failed: " . $connection->connect_error);

            echo "Connected successfully<br><br>";

            $query = "SELECT * FROM users";
            $result = $connection->query($query);

            echo "EMAIL : PASSWORD_HASH : DISPLAY_NAME<br>";
            echo "------------------------------------<br>";
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                    echo $row["email"]. " : " . $row["password_hash"]. " : " . $row["display_name"] . "<br>";
            }
            else
                echo "0 results";

            $connection->close();
        ?>
    </body>
</html>
