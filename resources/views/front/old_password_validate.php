<?php 
session_start();
include_once("config.php");

$pass = $_REQUEST['pass'];
if($_REQUEST['pass']!=""){
    	$result = $mysqli->query("SELECT * FROM  service_providers WHERE service_provider_password='$pass' and `service_provider_id`='".$_SESSION['service_provider_id']."'");
   		if($result->num_rows>0)
		{  
		echo "available";
		}
		else
		{
		echo "already";	
		}
		}

?>