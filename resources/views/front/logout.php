<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
session_destroy();
header("Location:login.php");  
?>
