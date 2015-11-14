<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
    </head>
    <body>
        <?php $GLOBALS['activeTab'] = 'Register'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Register</div>
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
                        <input type="password" class="form-control" id="password" placeholder='Password' pattern='[A-Za-z0-9]{8,16}' title="Password must be between 8 to 16 characters and consist of A-Z a-z 0-9">
                    </div>
                </div>
                <hr class="col-sm-offset-3 col-sm-6">
                <div class="form-group">
                    <label for="display-name" class="col-sm-3 control-label">Display name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="display-name" placeholder='Display name'>
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
