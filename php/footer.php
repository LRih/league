<footer>
    <?php
        $start_year = 2015;
        $cur_year = date('Y');
        $str = $start_year.(($start_year != $cur_year) ? "-".$cur_year : "");
        echo 'Copyright &copy; '.$str;
    ?>
</footer>
