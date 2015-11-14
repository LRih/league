<?php error_reporting(0); session_start(); ?>

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
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
