<?php 
session_start();
include_once("Config.php");

$email = $_REQUEST['email'];
if($_REQUEST['email']!=""){
    	$result = $mysqli->query("SELECT * FROM  service_providers WHERE service_provider_email='$email'");
   		if($result->num_rows>0)
		{  
		echo "already";
		}
		else
		{
		echo "available";	
		}
		}

?>