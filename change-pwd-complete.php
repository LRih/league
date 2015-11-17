<?php include_once('php/global.php') ?>

<?php
    if (!isset($_SESSION['allow_change_pwd_complete']))
        header('Location: index.php');

    unset($_SESSION['allow_change_pwd_complete']);

    if (!isset($_GET['username']))
        header('Location: index.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
        <script type='text/javascript' src='script/register.js'></script>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Login'; include_once('php/nav.php') ?>
        <div id='content'>
            <div id='login-container'>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Password change successful</div>
                    </div>
                    <div class="panel-body">Password has been changed for user "<?php echo htmlspecialchars($_GET['username']) ?>". User has been logged out.</div>
                </div>
            </div>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
