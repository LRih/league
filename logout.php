<?php

session_start();

include_once('php/auth.php');
logout();
header('Location: index.php');

?>