 <?php
include_once 'Config.php';
$query_time=$mysqli->query("select now() As ss");
$rrt=$query_time->fetch_assoc();
?>
<div>Server Time :&nbsp;<?php echo $rrt['ss'];?>
</div>
