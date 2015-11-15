<?php error_reporting(0); session_start(); ?>

<?php
    include_once('php/auth.php');

    $email_err; $pwd_err; $re_pwd_err; $name_err;

    if (is_authd())
        header('Location: index.php');
    else if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (!is_email_valid($_POST['email'])) $email_err = 'Email invalid.';
        else if (is_email_exist($_POST['email'])) $email_err = 'Email already exists.';

        // TODO validate password and name
        // TODO if error, populate posted data in forms

        register($_POST['email'], $_POST['password'], $_POST['name']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
        <script type='text/javascript' src='script/register.js'></script>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Register'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Register</div>
            <form class="form-horizontal" onsubmit="return validateForm()" method='post'>

                <?php echo isset($email_err) ? '<div class="form-group has-error has-feedback">' : '<div class="form-group has-feedback">' ?>
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name='email' placeholder='Email' maxlength='50' required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($email_err)) echo $email_err ?></span>
                    </div>
                </div>
                <?php echo isset($pwd_err) ? '<div class="form-group has-error has-feedback">' : '<div class="form-group has-feedback">' ?>
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name='password' placeholder='Password' maxlength='16' pattern='[A-Za-z0-9]{8,16}' required title="Password must be between 8 to 16 characters and consist of A-Z a-z 0-9">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($pwd_err)) echo $pwd_err ?></span>
                    </div>
                </div>
                <?php echo isset($re_pwd_err) ? '<div class="form-group has-error has-feedback">' : '<div class="form-group has-feedback">' ?>
                    <label for="retype-password" class="col-sm-3 control-label">Retype password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="retype-password" name='retype-password' placeholder='Retype password' maxlength='16'>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($re_pwd_err)) echo $re_pwd_err ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <hr class="col-sm-offset-3 col-sm-6">
                </div>

                <?php echo isset($name_err) ? '<div class="form-group has-error has-feedback">' : '<div class="form-group has-feedback">' ?>
                    <label for="name" class="col-sm-3 control-label">Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name='name' placeholder='Name' maxlength='50' pattern="[A-Za-z0-9' ]{2,50}" required title="Name must be between 2 to 50 characters and consist of A-Z a-z 0-9, spaces and apostrophes">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($name_err)) echo $name_err ?></span>
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
