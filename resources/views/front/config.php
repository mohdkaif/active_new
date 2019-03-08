<?php

$mysqli = new mysqli("localhost","root","Igniterpro@123","active_baccha");
if(mysqli_connect_errno()){
    
  trigger_error('Connection failed: '.$mysqli->error);
}
else{
   // $mysqli->query("SET NAMES 'utf8'");
   // $mysqli->query("SET CHARACTER SET utf8");
	//$mysqli->query("SET sql_mode=''");
}
date_default_timezone_set('Asia/Kolkata');






?>