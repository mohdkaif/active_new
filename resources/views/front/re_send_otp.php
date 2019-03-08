<?php 
session_start();
include_once("config.php");

$phone = $_REQUEST['id'];
if($_REQUEST['id']!=""){
	
    	$result = $mysqli->query("SELECT * FROM  service_providers WHERE service_provider_phone='$phone'");
   		if($result->num_rows>0)
		{ 
		$otp=rand(10000,99999);
		 $mysqli->query("UPDATE `service_providers` SET `otp`='$otp' WHERE  `service_provider_phone`='".$phone."'");
			echo "yes";
		}
		else
		{
		echo "available";	
		}
		}

?>