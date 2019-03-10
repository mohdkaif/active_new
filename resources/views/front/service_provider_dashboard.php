<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
if($_SESSION['service_provider_id']=='')
{
	header('Location: login.php');
}

if(isset($_POST['chnage_password']))
{
	//echo '<pre>';
	//print_r($_POST);exit;
	
	if($_POST['old_password']<>'' && $_POST['new_password']<>'' && $_POST['re-password']<>'')
	{
	
	$old_password=addslashes($_POST['old_password']);
	$new_password=addslashes($_POST['new_password']);
	
	$check=$mysqli->query("SELECT * FROM  service_providers WHERE service_provider_password='$old_password'");
	if($check->num_rows>0)
	{
		$res=$mysqli->query("UPDATE `service_providers` SET `service_provider_password`='$new_password',`service_provider_edit_time`='$date' WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
		
		$msg='<div class="alert alert-success"><strong>Thank You!</strong> Password change successfully saved.</div>';
		
	}
	}
	else
	{
		$msg='<div class="alert alert-danger"><strong>Oh snap!</strong> something went wrong.</div>';
	}
}

$provider=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
$provider_res=$provider->fetch_assoc();

$dob=date("d M Y", strtotime($provider_res['service_provider_dob']));

$cityquery=$mysqli->query("SELECT * FROM city WHERE city_id='".$provider_res['present_city']."'");
$city_res=$cityquery->fetch_assoc();
					 
$cityquery1=$mysqli->query("SELECT * FROM city WHERE city_id='".$provider_res['permanent_city']."'");
$city_res1=$cityquery1->fetch_assoc();
					 
$state=$mysqli->query("SELECT * FROM `state` where state_id='".$provider_res['present_state']."'");
$state_res=$state->fetch_assoc();
					 
$state1=$mysqli->query("SELECT * FROM `state` where state_id='".$provider_res['permanent_state']."'");
$state_res1=$state1->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
     <title>WELCOME TO THE ACTIVE BACCHA</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <!-- Stylesheets -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      
      <link href="css/style.css" rel="stylesheet">
     
      <link href="css/responsive.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Responsive -->
      <style>
         .icon-box i {
    font-size: 77px;
}
      </style>
       <?php include_once("function_validation.php");?>
   </head>
   <body>
      </head>
      <body>
         <div class="page-wrapper">
            <!-- Main Header-->
            <!--End Main Header -->
            <!--Main Slider-->
           
         <div id="wrapper">
             <section class="">
               <?php include_once("include/header.php"); ?>
        
         </section>
      <div class="page-wrapper">
         <!-- Main Header-->
         <!--End Main Header -->
         
         <!--Main Slider  background-image:url(images/bannertop.png); -->
         <section class="page-title" style="background: #31697f; height: 300px">
         
            <div class="auto-container">
               
       <h1 style="color:#f0eeee;">Welcome <span class="text-sky" style="color: #e88060!important;">  <?php echo $provider_res['service_provider_fname'].' '.$provider_res['service_provider_lname'];?></span></h1>
               
            </div>
         </section>
         <section class="user">
                    <img src="images/user.png" class="img-circle center-block" >
         </section>
      <?php include('dashabord-slider.php') ?>
       <?php if(isset($msg)){ echo $msg ;} ?>
     <section class="gallery-full-width style-two" style="background: #f4f4f4">
        <div class="mixitup-gallery">
          <div class="auto-container">
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    
                
            </div>
                </div>
                <br>
                <div class="row" style="padding: 10px; background: #f9f9f9;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 
                    <div class="table-responsive ">
                        <table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-user" aria-hidden="true"></i> Profile</h3></td>
                               
                                
                            </tr>
                         </table>
                        <table class="table" border="0">
                            <thead>
                                <tr >
                                    <td class="text-center"><b>Name</b></td>
                                    <td class="text-center"><b>Email</b></td>
                                    <td class="text-center"><b>Mobile </b></td>
                                    <td class="text-center"><b>Date of Birth</b></td>
                                    <td class="text-center"><b>Gender</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-center"><?php echo $provider_res['service_provider_fname'].' '.$provider_res['service_provider_lname'];?></td>
                                <td class="text-center"><?php echo $provider_res['service_provider_email'];?></td>
                                <td class="text-center"><?php echo $provider_res['service_provider_phone'];?></td>
                                <td class="text-center"><?php echo  $dob;?></td>
                                <td class="text-center"><?php echo $provider_res['service_provider_gender'];?></td>
                                </tr>
                                 
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <div class="table-responsive ">
                        <table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-crosshairs" aria-hidden="true"></i> Specialization</h3></td>
                            </tr>
                         </table>
                        <table class="table" border="0">
                            <thead>
                                <tr >
                                    <td class="text-left"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-left">
                                <?php 
								$sep=$mysqli->query("SELECT * FROM `service_sub_category`");
                     			while($sep_res=$sep->fetch_assoc())
								{
					 				$f=$sep_res['service_sub_category_name']; 
                 	 				$g=$sep_res['service_sub_category_id'];
					 				$c= explode(',',$provider_res['specialization']);
									for($i=0;$i<count($c);$i++)
									{ 
										if($c[$i]==$g)
										{  echo $f.' , ';
						
								 }}} ?>
                                </td>
                                </tr>
                                 
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <div class="table-responsive ">
                        <table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-map-marker" aria-hidden="true"></i> Present Address</h3></td>
                            </tr>
                         </table>
                        <table class="table" border="0">
                            <thead>
                                <tr >
                                    <td class="text-center"><b>State</b></td>
                                    <td class="text-center"><b>City</b></td>
                                    <td class="text-center"><b>Region </b></td>
                                    <td class="text-center"><b>Pin-Code</b></td>
                                    <td class="text-center"><b>Address</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-center"><?php echo $state_res['state_name']; ?></td>
                                <td class="text-center"><?php echo $city_res['city_name']; ?></td>
                                <td class="text-center"><?php echo $provider_res['present_region']; ?></td>
                                <td class="text-center"><?php echo $provider_res['present_pin_code']; ?></td>
                                <td class="text-center"><?php echo $provider_res['present_address']; ?></td>
                                </tr>
                                 
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <div class="table-responsive ">
                        <table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-map-marker" aria-hidden="true"></i> Permanent Address</h3></td>
                               
                                
                            </tr>
                         </table>
                        <table class="table" border="0">
                            <thead>
                                <tr >
                                    <td class="text-center"><b>State</b></td>
                                    <td class="text-center"><b>City</b></td>
                                    <td class="text-center"><b>Region </b></td>
                                    <td class="text-center"><b>Pin-Code</b></td>
                                    <td class="text-center"><b>Address</b></td>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                <td class="text-center"><?php echo $state_res1['state_name']; ?></td>
                                <td class="text-center"><?php echo $city_res1['city_name']; ?></td>
                                <td class="text-center"><?php echo $provider_res['permanent_region']; ?></td>
                                <td class="text-center"><?php echo $provider_res['permanent_pin_code']; ?></td>
                                <td class="text-center"><?php echo $provider_res['permanent_address']; ?></td>
                                </tr>
                                 
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <div class="table-responsive ">
                        <table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-graduation-cap"></i> Qualification</h3></td>
                            </tr>
                         </table>
                        <table class="table" border="0">
                            <thead>
                                <tr >
                                    <td class="text-center"><b>Qualification</b></td>
                                    <td class="text-center"><b>Year</b></td>
                                    <td class="text-center"><b>Action</b></td>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                <td class="text-center">Btech</td>
                                <td class="text-center">2013</td>
                                <td class="text-center">
                                <a href="#edit_education<?php echo $bank_res['bank_account_id'];?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-s1"><i class="fa fa-pencil"></i></a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <form method="post" action="" id="contact-form" >
                     	<table class="table contact-form">
                            <tr>
                                 <td class="sec-title"><h3><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change your Password</h3></td>
                               
                                
                            </tr>
                         </table>
                              <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                 <label style="color: #000">
                                 Old Password
                                 </label>
                                 <input type="text" class="form-control" onBlur="old_password_validate(this.value)" id="old_password" name="old_password" autocomplete="off" placeholder=" Old Password *" required>
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                <label style="color: #000">New password</label>
                                 <input type="password" name="new_password" class="form-control" onBlur="passvalidate(this.value)" id="passworduser"  autocomplete="off" placeholder=" Password *" required>
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                  <label style="color: #000">Confirm Password</label>
                                 <input type="password" name="re-password" class="form-control" autocomplete="off" onBlur="conformval();" id="cpasswordUser" placeholder=" Re-Password *" required>
                              </div>
                              <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                 <label style="color: #fff;">Last Namerg</label>
                                 <button type="submit" name="chnage_password" value="" class="theme-btn btn-style-one pull-left">Change Now</button> 
                              </div>
                          </form>
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