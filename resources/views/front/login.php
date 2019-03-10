<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');

if(isset($_POST['login_provider']))
{
	//echo '<pre>';
	//print_r($_POST);exit;
	
	$username=addslashes($_POST['username']);
	$password=addslashes($_POST['password']);
	
	$check=$mysqli->query("SELECT * FROM `service_providers` WHERE (`service_provider_email`='$username' OR `service_provider_phone`='$username') AND `service_provider_password`='$password'");
	if($check->num_rows>0)
	{
		$check_res=$check->fetch_assoc();
		$SecretKey="active_baccha";
		$t = bin2hex(openssl_random_pseudo_bytes(16));
    	$token=$SecretKey.$t;
		
		$mysqli->query("UPDATE `service_providers` SET `token`='$token' WHERE `service_provider_id`='".$check_res['service_provider_id']."'");
		
		$_SESSION['service_provider_id']=$check_res['service_provider_id'];
		$_SESSION['token']=$token;
		$_SESSION['type']='provider';
		$_SESSION['service_provider_email']=$check_res['service_provider_email'];
		$_SESSION['service_provider_phone']=$check_res['service_provider_phone'];
		$_SESSION['service_provider_status']=$check_res['service_provider_status'];
		
		header('Location: service_provider_dashboard.php');
		
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
     <script type="text/javascript">
         $(function() {
         
         // listen for changes
         $('.click input[type="radio"]').on('change', function(){
         
         // get checked one            
         var $target = $('.click input[type="radio"]:checked');
         // hide all divs with .showhide class
         $(".showhide").hide();
         // show div that corresponds to selected radio.
         $( $target.attr('data-section') ).show();
         
         // trigger the change on page load
         }).trigger('change');
         
         });
      </script>
   </head>
   <body>
         <div class="page-wrapper">
          <?php include_once("include/header.php"); ?>
            <!-- Main Header-->
            <!--End Main Header -->
            <!--Main Slider-->
           
        
             
       <section class="page-title" style="background-image:url(images/main-slider/eight-1.jpg);">
         
            <div class="auto-container">
               
               <h1 class="text-sky">Login</h1>
               
            </div>
         </section>
       
 <section class="intro-section">
  <div class="container">
    
    <!--our-quality-shadow-->
    <div class="clearfix"></div>
    <div class="row">
       
       <div class="tab" role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab"></i>User Login</a></li>
                     <li role="presentation"><a href="#Section2" aria-controls="settings" role="tab" data-toggle="tab">Service Provider</a></li>
                     <li role="presentation"><a href="#Section3" aria-controls="profile" role="tab" data-toggle="tab">Guest Login</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">

                     <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <div class="contact-formlogin">
                        <!--Contact Form-->
                        <form method="post" action="#" id="contact-form" novalidate>

                            <div class="row clearfix">

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                                    <label>

                                     E-mail/Phone

                                    </label>

                                    <input type="text" name="username" placeholder="E-mail/Phone *" required>

                                </div>

                                

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                                  <label>

                                      Password

                                    </label>

                                    <input type="password" name="username" placeholder="Password *" required>

                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">

                                    <button type="submit" class="theme-btn btn-style">Login</button>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">

                                  <p class="pull-right">Forgot Password ?</p>

                                </div>

                            </div>

                        </form>

                    </div>

                     </div>

                     <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <div class="contact-formlogin">
                        <!--Contact Form-->
                        <form method="post" action="" id="contact-form" >
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label>E-mail/Phone</label>
                                    <input type="text" name="username" placeholder="E-mail/Phone *" required>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>Password</label>
                                    <input type="password" name="password" placeholder="Password *" required>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                                    <button type="submit" name="login_provider" class="theme-btn btn-style">Login</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">
                                  <p class="pull-right">Forgot Password ?</p>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                    
                    

                     <div role="tabpanel" class="tab-pane fade" id="Section3">

                       <div class="contact-formlogin">

                        <!--Contact Form-->

                        <form method="post" action="#" id="contact-form" novalidate>

                            <div class="row clearfix">

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                                    <label>

                                     E-mail/Phone

                                    </label>

                                    <input type="text" name="username" placeholder="E-mail/Phone *" required>

                                </div>

                                

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                                  <label>

                                      Password

                                    </label>

                                    <input type="password" name="username" placeholder="Password *" required>

                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">

                                    <button type="submit" class="theme-btn btn-style">Login</button>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">

                                  <p class="pull-right">Forgot Password ?</p>

                                </div>

                            </div>

                        </form>

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