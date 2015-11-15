<?php error_reporting(0); session_start(); ?>

<?php
    include_once('php/auth.php');

    if (is_authd())
        header('Location: index.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Register'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Register</div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" placeholder='Email' maxlength='50'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" placeholder='Username' pattern='[A-Za-z0-9]{8,16}' title="Username must be between 8 to 16 characters and consist of A-Z a-z 0-9">
                    </div>
                </div>
                <div class="form-group">
                    <hr class="col-sm-offset-3 col-sm-6">
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" placeholder='Password' maxlength='16' pattern='[A-Za-z0-9]{8,16}' title="Password must be between 8 to 16 characters and consist of A-Z a-z 0-9">
                    </div>
                </div>
                <div class="form-group has-error has-feedback">
                    <label for="retype-password" class="col-sm-3 control-label">Retype password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="retype-password" placeholder='Retype password' maxlength='16'>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block">Test error.</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
