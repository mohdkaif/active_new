<?php
session_start();
 include_once 'Config.php';

 $_SESSION['rate']=$_POST['rate'];



 echo $_SESSION['price'] * $_SESSION['rate'];
 ?>
 
 