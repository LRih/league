<?php include_once('php/global.php') ?>

<?php
    include_once('php/auth.php');
    include_once('php/cls/password-change.php');
    include_once('php/cls/registration.php');

    $pwd_change;

    if (!is_authd())
        header('Location: index.php');
    else if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $pwd_change = new PasswordChange(get_account(), $_POST['cur-password'], $_POST['password'], $_POST['retype-password']);
        if ($pwd_change->try_change())
        {
            $_SESSION['allow_change_pwd_complete'] = true;
            header('Location: change-pwd-complete.php?username='. get_account()->username());
        }
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
        <?php $GLOBALS['active_tab'] = 'Account'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Change Password</div>
            <form class="form-horizontal" onsubmit="return validateForm()" method='post'>

                <div class="form-group has-feedback">
                    <label for="cur-password" class="col-sm-3 control-label">Current password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="cur-password" name='cur-password' placeholder='Current password' maxlength='50' required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($pwd_change)) echo $pwd_change->cur_password_err() ?></span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 control-label">New password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name='password' placeholder='New password' maxlength='16' pattern='[A-Za-z0-9]{8,16}' required title="Password must be between 8 to 16 characters and consist of A-Z a-z 0-9">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($pwd_change)) echo $pwd_change->new_password_err() ?></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="retype-password" class="col-sm-3 control-label">Retype password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="retype-password" name='retype-password' placeholder='Retype password' maxlength='16'>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($pwd_change)) echo $pwd_change->retyped_password_err() ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">OK</button>
                    </div>
                </div>

            </form>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
