<?php
error_reporting(E_ALL);
session_start();

if(!isset($_SESSION["username"])){
header("Location: all-login.php");
exit(); }
?>
