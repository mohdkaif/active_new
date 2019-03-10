<script>

window.setInterval(function(){  

$("#time").load("hh.php");

}, 1000);

</script>

<style>

#time{padding-left: 30%; top:5px; font-size:20px; color:#fff;font-weight:500;}

</style>



<?php

 $query=$mysqli->query("SELECT * FROM admin WHERE userName='".$_SESSION['adminUName']."'");

 $adminsRes=$query->fetch_assoc();

?>

<nav class="main-header navbar navbar-expand border-bottom navbar-light bg-success">

    <!-- Left navbar links -->

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>

      </li>

     

    </ul>



<div align="center" id="time"></div>



    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">

     <li class="dropdown user user-menu">

         <a href="#" class=""  data-toggle="dropdown">

                  <img src="images/<?php echo $adminsRes['imageAdmin'];?>" class="user-image" alt="User Image">

                  <span class="hidden-xs"><?php echo $adminsRes['nameAdmin'];?></span>

          </a>

           <ul class="dropdown-menu">

             <!-- User image -->

              <li class="user-header">

               <img src="images/<?php echo $adminsRes['imageAdmin'];?>" class="img-circle" alt="User Image">

                <p>

                  <?php echo $adminsRes['nameAdmin'];?>

                </p>

              </li>

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="pull-left">

                 <a href="editprofile.php" class="btn btn-default btn-flat">Profile</a>

               </div>

                <div class="pull-right">

                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>

               </div>

              </li>

            </ul>

      </li>

      <!-- <li class="nav-item">

        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i

            class="fa fa-th-large"></i></a>

      </li> --> 

    </ul>

  </nav>