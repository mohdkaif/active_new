<?php
session_start();
if ($_SESSION['adminUName']==''){
  header('Location:login.php');
}
include_once 'Config.php';
$id=$_POST['id'];
$query=$db->query("SELECT * FROM `enquiry` WHERE `enquiry_id`='$id'");
if($query->num_rows > 0){
$query1=$db->query("DELETE FROM `enquiry` WHERE `enquiry_id`='$id'");
$ret='yes';
}
else{
$ret='no';
}
echo $ret;
?>
