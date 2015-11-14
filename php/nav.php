<nav id='navbar'>
    <div id='nav-container'>
        <a id='nav-title-container' href='index.html'>
            <img id='nav-logo' src='images/logo.png'>
            <span id='nav-title'>League King</span>
        </a>
        <div id='tab-container' class='no-mob'>
            <?php
                $links = ['index', 'boosting', 'contact', '', 'register', 'login'];
                $tabs = ['Home', 'Boosting', 'Contact', '<div>', 'Register', 'Log in'];

                for ($i = 0; $i < count($tabs); $i++)
                {
                    $link = $links[$i];
                    $tab = $tabs[$i];
                    $active = ($GLOBALS['activeTab'] === $tab);

                    if ($tab === '<div>')
                        echo '<span class=\'tab-divider\'></span>';
                    else
                        echo '<a class=\''.($active ? 'active ' : '').'tab\' href=\''.$link.'.php\'>'.$tab.'</a>';
                }
            ?>
            <div id='slider'></div>
        </div>
        <img id='nav-menu' class='mob' src='images/menu.png' alt='Menu'>
    </div>
    <div class='mob'>
        <div id='tabs-dropdown'>
            <?php
                $links = ['index', 'boosting', 'contact', '', 'register', 'login'];
                $tabs = ['Home', 'Boosting', 'Contact', '<div>', 'Register', 'Log in'];

                for ($i = 0; $i < count($tabs); $i++)
                {
                    $link = $links[$i];
                    $tab = $tabs[$i];

                    if ($tab !== '<div>')
                        echo '<a href=\''.$link.'.php\'>'.$tab.'</a>';
                }
            ?>
        </div>
    </div>
</nav>
