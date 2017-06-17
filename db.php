<?php
ini_set('display_errors', 'On');

$HOST = 'localhost';
$USER = 'root';
$PASSWORD = 'root';
$DATABASE = 'polls';

$db = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
if ($db == false) {
    die('Database connection error ' . mysqli_connect_error());
}
