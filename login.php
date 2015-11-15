<?php error_reporting(0); session_start(); ?>

<?php
    include_once('php/auth.php');

    if (is_authd())
        header('Location: index.php');
    else if ($_SERVER['REQUEST_METHOD'] === 'POST' && authenticate($_POST['email'], $_POST['password']))
        header('Location: index.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Login'; include_once('php/nav.php') ?>
        <div id='content'>
            <div id='login-container'>
                <div class='heading'>Login</div>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$authd)
                        include_once('php/login-failure.php');
                ?>
                <form class="form-horizontal" method='post'>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name='email' placeholder='Email' maxlength='50' required>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password" class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name='password' placeholder='Password' maxlength='30' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
