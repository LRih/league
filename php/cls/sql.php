<?php

class SQL
{
    public static function connection()
    {
        return new mysqli('localhost', 'root', '', 'league');
    }
}

?>