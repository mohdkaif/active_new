
<?php
session_start();
if ($_SESSION['adminUName']==''){
  header('Location:login.php');
}
include_once 'Config.php';
$id=$_POST['id'];
$query=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='$id'");
if($query->num_rows > 0){
$query1=$mysqli->query("DELETE FROM `service_providers` WHERE `service_provider_id`='$id'");
$ret='yes';
}
else{
$ret='no';
}
echo $ret;
?>

