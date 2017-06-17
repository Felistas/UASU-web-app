<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:index.php');

} else {
    function auth($col)
    {
        $user = $_SESSION['user'];
        return @$user->$col;
    }
}

