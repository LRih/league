<?php

class sql
{
    public static function connection()
    {
        return new mysqli('localhost', 'root', '', 'league');
    }
}

?>