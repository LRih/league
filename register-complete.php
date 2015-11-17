<?php include_once('php/global.php') ?>

<?php
    include_once('php/auth.php');

    if (!isset($_SESSION['allow_reg_complete']))
    {
        header('Location: index.php');
        die();
    }

    unset($_SESSION['allow_reg_complete']);

    if (is_authd() || !isset($_GET['username']))
    {
        header('Location: index.php');
        die();
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
            <div id='login-container'>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Registration successful</div>
                    </div>
                    <div class="panel-body">User "<?php echo htmlspecialchars($_GET['username']) ?>" has been registered.</div>
                </div>
            </div>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
