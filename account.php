<?php include_once('php/global.php') ?>

<?php
    include_once('php/auth.php');

    if (!is_authd())
    {
        header('Location: login.php');
        die();
    }

    $acc = get_account();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Account'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Account</div>
            <div class="panel panel-default">
                <div class="panel-body">
                    Username: <?php echo $acc->username() ?><br>
                    Email: <?php echo $acc->email() ?><br><br>
                    Verified: <?php echo ($acc->is_verified() ? 'Yes' : 'No') ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <a class="btn btn-default" href="change-pwd.php" role="button">Change password</a>
                    <a class="btn btn-default" href="<?php echo 'email-verify.php?u=' . $acc->username() . '&v=' . $acc->verification_code() ?>" role="button">Verify email (NA)</a>
                </div>
            </div>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
