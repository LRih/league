<?php include_once('php/global.php') ?>

<?php
    include_once('php/auth.php');
    include_once('php/cls/registration.php');

    $reg;

    if (is_authd())
        header('Location: index.php');
    else if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $reg = new registration($_POST['username'], $_POST['email'], $_POST['password'], $_POST['retype-password']);
        if ($reg->try_register())
        {
            $_SESSION['allow_reg_complete'] = true;
            header('Location: register-complete.php?username='. $_POST['username']);
        }
    }
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
            <div class='heading'>No client-side input validation registration check</div>
            <form class="form-horizontal" onsubmit="return validateForm()" method='post'>

                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-3 control-label">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" name='username' placeholder='Username'
                            value="<?php if (isset($_POST['username'])) echo htmlspecialchars($_POST['username']) ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($reg)) echo $reg->username_err() ?></span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="email" name='email' placeholder='Email'
                            value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']) ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($reg)) echo $reg->email_err() ?></span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="password" name='password' placeholder='Password'
                            value="<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password']) ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($reg)) echo $reg->password_err() ?></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="retype-password" class="col-sm-3 control-label">Retype password:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="retype-password" name='retype-password' placeholder='Retype password'
                            value="<?php if (isset($_POST['retype-password'])) echo htmlspecialchars($_POST['retype-password']) ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php if (isset($reg)) echo $reg->retyped_password_err() ?></span>
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
