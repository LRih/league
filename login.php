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
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" placeholder='Email'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" placeholder='Password'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">Log in</button>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
