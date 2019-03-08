
<?php
session_start();
if ($_SESSION['adminUName']==''){
  header('Location:login.php');
}
include_once 'Config.php';
$id=$_POST['id'];
$query=$mysqli->query("SELECT * FROM `package` WHERE `package_id`='$id'");
if($query->num_rows > 0){
$query1=$mysqli->query("DELETE FROM `package` WHERE `package_id`='$id'");
$ret='yes';
}
else{
$ret='no';
}
echo $ret;
?>

