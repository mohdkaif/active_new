<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
if($_SESSION['service_provider_id']=='')
{
	header('Location: service_provider_dashboard.php');
}

$id=$_POST['id'];

$query=$mysqli->query("SELECT * FROM `upload_doc` WHERE `doc_id`='$id'");

if($query->num_rows > 0){

$query1=$mysqli->query("DELETE FROM `upload_doc` WHERE `doc_id`='$id'");

$ret='yes';

}

else{

$ret='no';

}

echo $ret;

?>

