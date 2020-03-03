<?php
ob_start();
session_start();
include 'Login.php';
include 'Actions.php';
include 'sales.php';

$login = new Login();
$action = new Actions();
$sellout = new Sales();

?>