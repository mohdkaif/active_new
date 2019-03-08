<?php
//DB details
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Igniterpro@123';
$dbName     = 'active_bachha';

//Create connection and select DB
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($mysqli->connect_error){
    die("Unable to connect database: " . $mysqli->connect_error);
}

?>
