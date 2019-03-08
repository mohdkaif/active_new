<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
if($_SESSION['service_provider_id']=='')
{
	header('Location: login.php');
}

$id=$_POST['id'];

$query=$mysqli->query("SELECT * FROM `bank_account` WHERE `bank_account_id`='$id'");

if($query->num_rows > 0){

$query1=$mysqli->query("DELETE FROM `bank_account` WHERE `bank_account_id`='$id'");

$ret='yes';

}

else{

$ret='no';

}

echo $ret;

?>

