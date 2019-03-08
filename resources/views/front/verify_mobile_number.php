<?php 
session_start();
include_once("config.php");
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
     <title>WELCOME TO THE ACTIVE BACCHA</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
       <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
     
      <link rel="stylesheet" type="text/css" href="css/signup.css">
      <!-- REVOLUTION NAVIGATION STYLES -->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <!-- Responsive -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
     
   
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <?php include_once("function_validation.php");?>
   </head>
   <body>
         <div class="page-wrapper">
          <?php include_once("include/header.php"); ?>
            <!-- Main Header-->
            <!--End Main Header -->
            <!--Main Slider-->
           
        
             
       <section class="page-title" style="background-image:url(images/main-slider/eight-1.jpg);">
         
            <div class="auto-container">
               
               <h1 class="text-sky">Verify Mobile</h1>
               
            </div>
         </section>
       
 <section class="intro-section">
  <div class="container">
    
    <!--our-quality-shadow-->
    <div class="clearfix"></div>
    <div class="row">
       
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
                                    <button type="submit" name="check_otp" class="theme-btn btn-style">Submit</button>
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
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
          <script src="js/price_range_script.js" type="text/javascript"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

         <script src="js/demo.js"></script>
         <script src="js/jquery.fancybox.js"></script>
         <script src="js/appear.js"></script>
         <script src="js/mixitup.js"></script>
         <script src="js/owl.js"></script>
         <script src="js/wow.js"></script>
         <script src="js/script.js"></script>
          <script src="js/multislider.js"></script>
     

        
         <script type="text/javascript">
          
            $('.burger, .overlay').click(function(){
            $('.burger').toggleClass('clicked');
            $('.overlay').toggleClass('show');
            $('nav').toggleClass('show');
            $('body').toggleClass('overflow');
            });
          
    $('.mixedSlider').multislider({
      duration: 1000,
      interval: 6000,
    });

         </script>
         <script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
   $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
   $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
   $("#profile-img").removeClass();
   $("#status-online").removeClass("active");
   $("#status-away").removeClass("active");
   $("#status-busy").removeClass("active");
   $("#status-offline").removeClass("active");
   $(this).addClass("active");
   
   if($("#status-online").hasClass("active")) {
      $("#profile-img").addClass("online");
   } else if ($("#status-away").hasClass("active")) {
      $("#profile-img").addClass("away");
   } else if ($("#status-busy").hasClass("active")) {
      $("#profile-img").addClass("busy");
   } else if ($("#status-offline").hasClass("active")) {
      $("#profile-img").addClass("offline");
   } else {
      $("#profile-img").removeClass();
   };
   
   $("#status-options").removeClass("active");
});

function newMessage() {
   message = $(".message-input input").val();
   if($.trim(message) == '') {
      return false;
   }
   $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
   $('.message-input input').val(null);
   $('.contact.active .preview').html('<span>You: </span>' + message);
   $(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});
//# sourceURL=pen.js
</script>
   </body>
</html>