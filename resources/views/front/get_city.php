<?php 
session_start();
include_once("config.php");

$city_id = $_REQUEST['city_id'];
if($_REQUEST['city_id']!=""){
    	$city = $mysqli->query("SELECT * FROM `city` WHERE `state_id`='$city_id'");
		if($city->num_rows>0)
		{
			echo '<option value="">-- City --</option>';
			while($city_res=$city->fetch_assoc())
			{
				echo '<option value="'.$city_res['city_id'].'">'.$city_res['city_name'].'</option>';
			}
		}
		}
?>