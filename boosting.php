<?php error_reporting(0); session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>League King</title>
        <?php include_once('php/head.php') ?>
        <script type='text/javascript' src='script/boosting.js'></script>
    </head>
    <body>
        <?php $GLOBALS['active_tab'] = 'Boosting'; include_once('php/nav.php') ?>
        <div id='content'>
            <div class='heading'>Boosting</div>
            <div id='boosting-select-container'>
                <div id='current-rank' class='rank-select-container'>
                    <div class='heading'>Current Rank</div>
                    <img class='division-img' src="images/div_bronze.png">
                    <div class="division-select margin-top dropdown">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button" data-toggle="dropdown">
                            Division
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bronze</a></li>
                            <li><a href="#">Silver</a></li>
                            <li><a href="#">Gold</a></li>
                            <li><a href="#">Platinum</a></li>
                            <li><a href="#">Diamond</a></li>
                            <li><a href="#">Masters</a></li>
                        </ul>
                    </div>
                    <div class="tier-select margin-top dropdown">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button" data-toggle="dropdown">
                            Tier
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Tier V</a></li>
                            <li><a href="#">Tier IV</a></li>
                            <li><a href="#">Tier III</a></li>
                            <li><a href="#">Tier II</a></li>
                            <li><a href="#">Tier I</a></li>
                        </ul>
                    </div>
                </div>
                <div id='desired-rank' class='rank-select-container'>
                    <div class='heading'>Desired Rank</div>
                    <img class='division-img' src="images/div_bronze.png">
                    <div class="division-select margin-top dropdown">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button" data-toggle="dropdown">
                            Division
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bronze</a></li>
                            <li><a href="#">Silver</a></li>
                            <li><a href="#">Gold</a></li>
                            <li><a href="#">Platinum</a></li>
                            <li><a href="#">Diamond</a></li>
                            <li><a href="#">Masters</a></li>
                            <li><a href="#">Challenger</a></li>
                        </ul>
                    </div>
                    <div class="tier-select margin-top dropdown">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button" data-toggle="dropdown">
                            Tier
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Tier V</a></li>
                            <li><a href="#">Tier IV</a></li>
                            <li><a href="#">Tier III</a></li>
                            <li><a href="#">Tier II</a></li>
                            <li><a href="#">Tier I</a></li>
                        </ul>
                    </div>
                </div>
                <div class='region-select-container'>
                    <div class='heading'>Select your region</div>
                    <div class="region-select margin-top dropdown">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button" data-toggle="dropdown">
                            Region
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Oceanic</a></li>
                            <li><a href="#">Europe West</a></li>
                            <li><a href="#">Europe Nordic & East</a></li>
                            <li><a href="#">North America</a></li>
                        </ul>
                    </div>
                    <button type="button" class="margin-top btn btn-primary btn-lg btn-block">Add to cart</button>
                </div>
            </div>
        </div>
        <?php include_once('php/footer.php') ?>
    </body>
</html>
