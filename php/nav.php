<?php
    include_once('php/auth.php');

    $username;

    $links = ['index', 'boosting', 'contact', ''];
    $tabs = ['Home', 'Boosting', 'Contact', '<div>'];

    if (isset($_SESSION['user_id']))
    {
        array_push($links, 'account', 'logout');
        array_push($tabs, 'Account', 'Logout');
    }
    else
    {
        array_push($links, 'register', 'login');
        array_push($tabs, 'Register', 'Login');
    }
?>

<nav id='navbar'>
    <div id='nav-container'>
        <a id='nav-title-container' href='index.php'>
            <img id='nav-logo' src='images/logo.png'>
            <span id='nav-title'>League King</span>
        </a>
        <div id='tab-container' class='no-mob'>
            <?php
                for ($i = 0; $i < count($tabs); $i++)
                {
                    $link = $links[$i];
                    $tab = $tabs[$i];
                    $active = ($GLOBALS['active_tab'] === $tab ? 'active ' : '');

                    if ($tab === '<div>')
                        echo '<span class=\'tab-divider\'></span>';
                    else
                    {
                        if ($tab === 'Account' && isset($_SESSION['user_id']))
                            echo '<span class="glyphicon glyphicon-user"></span>';
                        echo '<a class=\'' . $active . 'tab\' href=\'' . $link . '.php\'>' . $tab . '</a>';
                    }
                }
            ?>
            <div id='slider'></div>
        </div>
        <img id='nav-menu' class='mob' src='images/menu.png' alt='Menu'>
    </div>
    <div class='mob'>
        <div id='tabs-dropdown'>
            <?php
                for ($i = 0; $i < count($tabs); $i++)
                {
                    $link = $links[$i];
                    $tab = $tabs[$i];
                    $active = ($GLOBALS['active_tab'] === $tab ? 'active ' : '');

                    if ($tab !== '<div>')
                        echo '<a class=\''.($active ? 'active' : '').'\' href=\'' . $link . '.php\'>' . $tab . '</a>';
                }
            ?>
        </div>
    </div>
</nav>
