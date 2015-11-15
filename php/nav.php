<?php
    include_once('php/auth.php');

    $account_link = 'account'; $account_tab = 'Account';
    $logout_link = 'logout'; $logout_tab = 'Logout';
    $username;

    $links = ['index', 'boosting', 'contact', ''];
    $tabs = ['Home', 'Boosting', 'Contact', '<div>'];

    if (!isset($_SESSION['user_id']))
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
                        echo '<a class=\'' . $active . 'tab\' href=\'' . $link . '.php\'>' . $tab . '</a>';
                }

                if (isset($_SESSION['user_id']))
                {
                    $username = get_username($_SESSION['user_id']);
                    $active = ($GLOBALS['active_tab'] === $account_tab ? 'active ' : '');
                    echo '<span class="glyphicon glyphicon-user"></span><a class=\'' . $active . 'tab\' href=\'' . $account_link . '.php\'>' . $username . '</a>';
                    echo '<a class=\'tab\' href=\'' . $logout_link . '.php\'>' . $logout_tab . '</a>';
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

                if (isset($_SESSION['user_id']))
                {
                    $active = ($GLOBALS['active_tab'] === $account_tab ? 'active ' : '');
                    echo '<a class=\'' . $active . '\' href=\'' . $account_link . '.php\'><span class="glyphicon glyphicon-user"></span> ' . $username . '</a>';
                    echo '<a href=\'' . $logout_link . '.php\'>' . $logout_tab . '</a>';
                }
            ?>
        </div>
    </div>
</nav>
