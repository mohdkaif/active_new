<?php 
session_start();
include_once("Config.php");
$date = date('Y-m-d H:i:s');

if(isset($_POST['check_otp']))
{
	//echo '<pre>';
	//print_r($_POST);
	//print_r($_SESSION);
	//exit;
	$otp=addslashes($_POST['otp']);
	
	if($otp<>'')
	{
	
	$check_otp=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."' and  `service_provider_phone`='".$_SESSION['service_provider_phone']."' and `otp`='$otp'");
	if($check_otp->num_rows>0)
	{
		$mysqli->query("UPDATE `service_providers` SET `otp`='',`phone_verify`='1' WHERE `service_provider_id`='".$_SESSION['service_provider_id']."' and  `service_provider_phone`='".$_SESSION['service_provider_phone']."'");
		$msg='<div class="alert alert-success"><strong>Thank You!</strong> Your data has been successfully saved.</div>';
		header('Location: login.php');
	}
	else
	{
		$msg='<div class="alert alert-danger"><strong>Oh snap!</strong> Please enter valid otp.</div>';
	}
	}
	else
	{
		$msg='<div class="alert alert-danger"><strong>Oh snap!</strong> something went wrong.</div>';
	}
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

      <link rel="stylesheet" type="text/css" href="css/signup.css">

      <!-- REVOLUTION NAVIGATION STYLES -->

      <link href="css/style.css" rel="stylesheet">

      <link href="css/responsive.css" rel="stylesheet">

      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <!-- Responsive -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link href="http://allfont.net/allfont.css?fonts=roboto-medium" rel="stylesheet" type="text/css" />
    <?php include_once("function_validation.php");?>

   </head>

   <body>

      <div class="page-wrapper">

         <!-- Main Header-->

         <!--End Main Header -->

         <!--Main Slider-->

      <section class="page-title" style="background-image:url(images/main-slider/image-2.jpg);">
            <?php include_once("include/header.php"); ?>
            <div class="auto-container">
               <h1 class="text-sky">Verify Phone</h1>
            </div>
         </section>
 <section class="intro-section">
  <div class="container">
    <div class="clearfix"></div>
    <div class="row">
       <div class="intro-text text-center">
                <h2>Verify Mobile</h2>
                <div class="anim-icon"><span class="icon icon-star"></span></div>
            </div>
             <?php if(isset($msg)){ echo $msg ;} ?>
       			<div class="tab" role="tabpanel">
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <div class="contact-formlogin">
                        <!--Contact Form-->
                       

                            <div class="row clearfix">
                             <form method="post" id="contact-form">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>Enter OTP</label>
                                    <input type="text" id="number_type" name="otp" maxlength="5" onBlur="number_validate(this.value)" placeholder="X-X-X-X-X" required>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                                    <button type="submit" name="check_otp" class="theme-btn btn-style">Login</button>
                                </div>
                             </form>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">
                                 <a href="javascript:void(0);" onClick="re_send_otp(<?php echo $_SESSION['service_provider_phone'];?>);">
                                 <p class="pull-right">Re-send OTP?</p>
                                 </a>
                                </div>
                            </div>
                        
                    </div>
                   </div>
                  </div>
               </div>
    </div>
  </div>
  </div>
</section>
        
      <?php include_once("include/footer.php"); ?>

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