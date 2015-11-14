<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php $GLOBALS['activeTab'] = 'Log in'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Login</div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" placeholder='Email'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" placeholder='Password'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">Log in</button>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once('php/footer.php') ?>
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
