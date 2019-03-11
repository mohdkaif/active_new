<?php 
session_start();
include_once("Config.php");
$date = date('Y-m-d H:i:s');

if(isset($_GET['token']))
{
$ttr=explode('-',$_GET['token']);
$check=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='".$ttr[1]."' and  `varify_code`='".$ttr[0]."'");
if($check->num_rows>0)
{
	$mysqli->query("UPDATE `service_providers` SET `varify_code`='',`email_verify`='1' WHERE `service_provider_id`='".$ttr[1]."'");
}
else
{
	header('Location: 404.php');
}
}
else
{
	header('Location: 404.php');
}
?>
<!DOCTYPE html>

<html lang="en">

   <head>

      <meta charset="utf-8">

      <title>Active Baccha</title>

      <!-- Stylesheets -->

      <link href="css/bootstrap.css" rel="stylesheet">

      <link href="plugins/revolution/css/settings.css" rel="stylesheet" type="text/css">

      <!-- REVOLUTION SETTINGS STYLES -->

      <link href="plugins/revolution/css/layers.css" rel="stylesheet" type="text/css">

      <!-- REVOLUTION LAYERS STYLES -->

      <link href="plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css">

      <!-- REVOLUTION NAVIGATION STYLES -->

      <link href="css/style.css" rel="stylesheet">

      <link href="css/responsive.css" rel="stylesheet">

      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

      <link rel="icon" href="images/favicon.png" type="image/x-icon">

      <!-- Responsive -->

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

      <style>

         .main-header .main-box {

         position: relative;

         padding: 0px 15px;

         left: 0px;

         top: 0px;

         width: 100%;

         z-index: 99;

         background-color: #ffff00;

         -webkit-transition: all 300ms ease;

         -moz-transition: all 300ms ease;

         -ms-transition: all 300ms ease;

         -o-transition: all 300ms ease;

         transition: all 300ms ease;

         border-radius: 33px;

         }

      </style>

   </head>

   <body>

      <div class="page-wrapper">

         <!-- Main Header-->

         <!--End Main Header -->

         <!--Main Slider-->

         <section class="page-title" style="background-image:url(images/main-slider/image-2.jpg);">

         <?php include_once 'include/header.php';?>

            

            <div class="auto-container">

              

               <h1 class="text-sky">Verify Email</h1>

               

            </div>

         </section>

      <section class="intro-section" style="margin-top: 37px;">

        <div class="auto-container">

            <div class="row clearfix">

                 <div class="image-column col-md-5 col-sm-12 col-xs-12">

                    <div class="inner-column">

                        <img src="images/about_left.jpg">

                    </div>

                </div>

                <div class="text-column col-md-7 col-sm-12 col-xs-12">

                    <div class="inner-column">

                        <span class="icon-1 doll-1 wow zoomInStable" data-wow-duration="2000ms" data-wow-delay="0ms"></span>

                        <span class="icon-2 doll-2 wow jello" data-wow-duration="1000ms" data-wow-delay="1000ms"></span>

                        <div class="sec-title">

                            <h2><span class="text-sky">Thank You</span> THE ACTIVE BACCHA </h2>

                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing elit psum dolor sit amet. Aenean consectetur fringilla mi in mollis. Etiam eleifend sollicitudin dignissim.  Lorem ipsum dolor sit amet, consectetur adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing elit psum dolor sit amet. Aenean consectetur fringilla mi in mollis. Etiam eleifend sollicitudin dignissim. </p>

                    </div>

         

                   

                </div>



                 

            </div>

        </div>

    </section>

        

        

      

      <?php include_once 'include/footer.php';?>

        

  

      </div>

      <!--End pagewrapper-->

      <!--Scroll to top-->

      <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>

      <script src="js/jquery.js"></script> 

      <script src="js/bootstrap.min.js"></script>

      <!--Revolution Slider-->

      <script src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>

      <script src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>

      <script src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>

      <script src="js/main-slider-script.js"></script>

      <!--End Revolution Slider-->

      <script src="js/jquery.fancybox.js"></script>

      <script src="js/appear.js"></script>

      <script src="js/mixitup.js"></script>

      <script src="js/owl.js"></script>

      <script src="js/wow.js"></script>

      <script src="js/script.js"></script>

      <script src="js/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>

      <script type="text/javascript">

         $(".demo2").bootstrapNews({

                 newsPerPage: 3,

                 autoplay: true,

                 pauseOnHover: true,

                 navigation: false,

                 direction: 'up',

                 newsTickerInterval: 2500,

                 onToDo: function () {

                     //console.log(this);

                 }

             });

      </script>

   </body>

</html>