<?php error_reporting(0); session_start(); ?>

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
            <form class="form-horizontal" method='post'>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="email" name='email' placeholder='Email' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name='password' placeholder='Password' required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">Log in</button>
                    </div>
                </div>
            </form>
            <?php
                include_once('php/auth.php');
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_valid($_POST['email'], $_POST['password']))
                    header('Location: index.php');
            ?>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
