<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');

if(isset($_POST['add_service_provider']))
{
	//echo '<pre>';
	//print_r($_POST);exit;
	
	$f_name=addslashes($_POST['service_provider_fname']);
	$l_name=addslashes($_POST['service_provider_lname']);
	$phone=addslashes($_POST['service_provider_phone']);
	$dob=addslashes($_POST['service_provider_dob']);
	$email=addslashes($_POST['service_provider_email']);
	$password=addslashes($_POST['service_provider_password']);
	$gender=addslashes($_POST['service_provider_gender']);
	
	$present_state=addslashes($_POST['present_state']);
	$present_city=addslashes($_POST['present_city']);
	$present_region=addslashes($_POST['present_region']);
	$present_pin_code=addslashes($_POST['present_pin_code']);
	$present_address=addslashes($_POST['present_address']);
	
	$permanent_state=addslashes($_POST['permanent_state']);
	$permanent_city=addslashes($_POST['permanent_city']);
	$permanent_region=addslashes($_POST['permanent_region']);
	$permanent_pin_code=addslashes($_POST['permanent_pin_code']);
	$permanent_address=addslashes($_POST['permanent_address']);
	
	$specialization=$_POST['specialization'];
	$ss='';
	for($i=0;$i<count($_POST['specialization']);$i++)
	{
		if($i==0)
		{
			$ss=$specialization[$i];
		}
		else
		{
			$ss=$ss.','.$specialization[$i];
		}
	}
	
	if($f_name<>'' && $email<>'' && $password<>'' && $phone<>'')
	{
		$SecretKey="active_baccha";
		$t = bin2hex(openssl_random_pseudo_bytes(16));
    	$token=$SecretKey.$t;
		$otp=rand(10000,99999);
		$device_type='Website';
		
		$insert=$mysqli->query("INSERT INTO `service_providers`(`token`,`varify_code`, `otp`,`device_type`, `specialization`, `service_provider_fname`, `service_provider_lname`, `service_provider_email`, `service_provider_password`, `service_provider_phone`, `service_provider_dob`, `service_provider_gender`, `present_state`, `present_city`, `present_region`, `present_pin_code`, `present_address`, `permanent_state`, `permanent_city`, `permanent_region`, `permanent_pin_code`, `permanent_address`, `service_provider_add_time`) VALUES ('$token','$t','$otp','$device_type','$ss','$f_name','$l_name','$email','$password','$phone','$dob','$gender','$present_state','$present_city','$present_region','$present_pin_code','$present_address','$permanent_state','$permanent_city','$permanent_region','$permanent_pin_code','$permanent_address','$date')");
		
		$last_id =$mysqli->insert_id;
		
		$_SESSION['service_provider_id']=$last_id;
		$_SESSION['service_provider_phone']=$phone;
		
		
		/////////////=============================== mail code ===================================//////////////////////
	
	            $mail=$email;
                $url='https://www.aafilogicinfotech.com/demo/active-baccha/';
	            $subject ="Active Baccha | Verification Email";   
               $message ='<table width="600" border="0" align="center" cellpadding="0" cellspacing="5" style="border:solid 1px #ccc; padding:6px 20px 20px; background:#3db8b7;">
				<tr>
				<td align="center"><img style="height: 100px;" src="'.$url.'images/logo.png"/></td>
				</tr>
				<tr>
				<td><strong style="font-family:helvetica; font-size:20px; font-weight:lighter;">Dear  '.$f_name.' '.$l_name.'</strong>,</td>
				</tr>
				<tr>
				<td><p style="font-family:helvetica; font-size:15px; line-height:24px;"><strong>Thanks For Joining us!</strong> You\'re now part of the Active Baccha community.<br>Click here to verify your email address. <br></p></td>
				</tr><br>
				<tr>
				<td align="center">
				<a href="'.$url.'verify_email.php?token='.$t.'-'.$last_id.'" style="background:#e96036; padding:10px; color:#fff; font-size:13px; font-family:arial; text-decoration:none;">Click Here</a>
				</td>
				</tr>
				
				<br>
				<tr style="font-family:helvetica; font-size:15px; line-height:24px;">
                    <td><strong>Best Regards</strong></td>
                  </tr>  
				   <tr style="font-family:helvetica; font-size:15px; line-height:24px;">
                    <td>Active Baccha Team</td>
                  </tr> 
				</table>';   
                $from='sandeep@aafilogicinfotech.com';
				
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";  
                $headers .= "To: ".$from." <".$from.">\r\n";  
                $headers .= "From: ".$from." <".$from.">\r\n";  
                $headers .= "Reply-To: ".$from." <".$from.">\r\n";  
                $headers .= "Return-Path: ".$from." <".$from.">\r\n";  
                $headers .= "\r\n";
                mail($mail,$subject,$message,$headers);
    
	////////////////////========================== mail end code =============================///////////////////////////////
	
	if($insert)
	{
		$msg='<div class="alert alert-success"><strong>Thank You!</strong> Your data has been successfully saved.</div>';
		
		header('Location: verify_mobile_number.php');
	}
	else
	{
		$msg='<div class="alert alert-danger"><strong>Oh snap!</strong> something went wrong.</div>';
	}
	
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
      <?php include_once("function_validation.php");?>
   </head>
   <body>
         <div class="page-wrapper">
          <?php include_once("include/header.php"); ?>
            <!-- Main Header-->
            <!--End Main Header -->
            <!--Main Slider-->
           
        
             
      <div class="page-wrapper">
        <section class="page-title" style="background-image:url(images/main-slider/eight-1.jpg);">
         
            <div class="auto-container">
               
               <h1 class="text-sky">Signup</h1>
               
            </div>
         </section>
         <section class="intro-section">
            <div class="container">
               <!--our-quality-shadow-->
               <div class="clearfix"></div>
               <div class="row">
                  <div class="intro-text text-center">
                     <h2>SIGNUP</h2>
                  
                  </div>
                  <div class="contact-formlogin">
                     <!--Contact Form-->
                    
                        <div class="row clearfix">
                           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <div class="click">
                                 <label class="radio"><p>User</p>
                                 <input type="radio" name="one" data-section="#div-1" value="01" checked>
                                 <span class="checkround"></span>
                                 </label>
                                 <label class="radio"><p>Service Provider</p>
                                 <input type="radio" name="one" data-section="#div-2" value="02">
                                 <span class="checkround"></span>
                                 </label>
                              </div>
                           </div>
                           
                           <?php if(isset($msg)){ echo $msg ;} ?>
                           <!--- user form Design ------------------>
                           <div id="div-1" class="showhide">
                            <form method="post" action="#" id="contact-form" novalidate>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>
                                 First Name
                                 </label>
                                 <input type="text" name="first-name" placeholder="First Name *" required>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>
                                 Last Name
                                 </label>
                                 <input type="text" name="last-name" placeholder="Last Name *" required>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <h2> Child details</h2>
                                 <div class="container1 row">
                                    <div  class="col-md-6 form-group">
                                       <label>Name</label>
                                       <input type="text" name="mytext[]" placeholder="Name *">
                                    </div>
                                    <div  class="col-md-6 form-group">
                                       <label> Age</label>
                                       <select  name="mytext[]" class="sele">
                                          <option>--Age--</option>
                                          <option>1</option>
                                          <option>2</option>
                                       </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div  class="col-md-6 form-group">
                                       <label> Gender</label>
                                       <ul class="list-inline">
                                          <li><label class="radio">Male
                                             <input type="radio" name="male" checked="checked">
                                             <span class="checkround"></span>
                                             </label>
                                          </li>
                                          <li><label class="radio">Female
                                             <input type="radio" name="female" >
                                             <span class="checkround"></span>
                                             </label></a>
                                          </li>
                                          <li><label class="radio">Other
                                             <input type="radio" name="other" >
                                             <span class="checkround"></span>
                                             </label>
                                          </li>
                                          <li class="pull-right"><button class="add_form_field btn-style">+ Add More</button></li>
                                       </ul>
                                       <div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>
                                 Mobile number
                                 </label>
                                 <input type="text" name="username" placeholder=" Mobile number *" required>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>
                                 OTP
                                 </label>
                                 <input type="password" name="username" placeholder=" OTP *" required>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <h2>Verify mail id</h2>
                                 <div class="container1 row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                       <label>Address </label>
                                       <textarea name="message" placeholder="Address" style="border-bottom: 1px solid rgba(119,119,119,1);
                                          height: 100px"></textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                       <label>
                                       Region
                                       </label>
                                       <input type="text" name="region" placeholder=" Region *" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>
                                       City 
                                       </label>
                                       <select  name="region" class="form-group">
                                          <option>-- City --</option>
                                          <option>Delhi</option>
                                          <option>Mumbai</option>
                                       </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>
                                       State 
                                       </label>
                                       <select  name="region" class="form-group">
                                          <option>-- State --</option>
                                          <option>Delhi</option>
                                          <option>Mumbai</option>
                                       </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>
                                       Password
                                       </label>
                                       <input type="password" name="password" placeholder=" Password *" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>
                                       Verify Password
                                       </label>
                                       <input type="password" name="password" placeholder=" Verify Password *" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                  <ul class="list-inline">
                                     <li><a href="#"><input type="checkbox" style="margin-left: 10px;height: 15px;width: 15px;"></a></li>
                                     <li><a href="#"> <label  style="margin-top: 12px;">
                                       Terms and condition 
                                       </label></a></li>
                                   </ul>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                 <button type="submit" class="theme-btn btn-style">Submit</button>
                              </div>
                              </form>
                           </div>
                           
                           <!--- Service provider form Design ------------------>
                           
                           <div id="div-2" class="showhide">
                           <form method="post" action="" enctype="multipart/form-data" id="contact-form"/>
                           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <h2> Personal Information</h2>
                            <div class="container1 row">
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>First Name</label>
                                 <input type="text" id="service_provider_fname" onBlur="namevalidate(this.value)" autocomplete="off" name="service_provider_fname" placeholder="First Name *" required>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>Last Name</label>
                                 <input type="text" id="service_provider_lname"  autocomplete="off" name="service_provider_lname" placeholder="Last Name *" >
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>Phone number</label>
                                 <input type="text" name="service_provider_phone" id="service_provider_phone" onBlur="mobilevalidate(this.value)" autocomplete="off" placeholder=" Phone number *"  required>
                              </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">       
                              <label>Specialization</label>
                              <select class="select2" multiple="multiple" name="specialization[]" data-placeholder="Select Specialization" style="width: 100%;" required>
                              <?php 
							  $sep=$mysqli->query("SELECT * FROM `service_sub_category` ORDER BY `service_sub_category_name` ASC");
							  if($sep->num_rows>0)
							  {
								  while($sep_res=$sep->fetch_assoc())
								  {
							  ?>
                                <option value="<?php echo $sep_res['service_sub_category_id'];?>"><?php echo $sep_res['service_sub_category_name'];?></option>
                                <?php }}?>
                              </select>
                            
                        </div>                   
                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                  <label>Date of birth</label>
                                  <input type="date" name="service_provider_dob" autocomplete="off" placeholder="Date of birth *" required>
                              </div>
                              
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>Email</label>
                                 <input type="email" onBlur="emailvalidate(this.value)" id="service_provider_email" name="service_provider_email" autocomplete="off" placeholder=" Email *" required>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>Password</label>
                                 <input type="password" name="service_provider_password" onBlur="passvalidate(this.value)" id="passworduser"  autocomplete="off" placeholder=" Password *" required>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label>Re-Password</label>
                                 <input type="password" name="re-password" autocomplete="off" onBlur="conformval();" id="cpasswordUser" placeholder=" Re-Password *" required>
                              </div>
                              
                              
                              <div  class="col-md-12 form-group">
                                       <label> Gender</label>
                                       <ul class="list-inline">
                                          <li><label class="radio"><p>Male</p>
                                             <input type="radio" name="service_provider_gender" checked="checked" value="Male">
                                             <span class="checkround"></span>
                                             </label>
                                          </li>
                                          <li><label class="radio"><p>Female</p>
                                             <input type="radio" name="service_provider_gender" value="Female" >
                                             <span class="checkround"></span>
                                             </label>
                                          </li>
                                          <li><label class="radio"><p>Other</p>
                                             <input type="radio" name="service_provider_gender" value="Other" >
                                             <span class="checkround"></span>
                                             </label>
                                          </li>
                                       </ul>
                                       <div>
                                       </div>
                                    </div>
                                    
                              </div>
                              </div>
                           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <h2> Present Address</h2>
                                 <div class="container1 row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>State</label>
                                       <select  name="present_state" class="form-group" onChange="get_city(this.value);" required>
                                          <option value="">-- State --</option>
                                          <?php 
										  $state=$mysqli->query("SELECT * FROM `state` ORDER BY `state_name` ASC");
										  if($state->num_rows>0)
										  {
											  while($state_res=$state->fetch_assoc())
											  {
										  ?>
                                          <option value="<?php echo $state_res['state_id'];?>"><?php echo $state_res['state_name'];?></option>
                                          <?php }}?>
                                       </select>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>City</label>
                                       <select  name="present_city" id="city" class="form-group" required>
                                          <option>-- City --</option>
                                       </select>
                                  </div>
                                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                       <label>Region</label>
                                       <input type="text" name="present_region" autocomplete="off" placeholder=" Region *" required>
                                  </div>
                                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                       <label>Pin Code</label>
                                       <input type="text" name="present_pin_code" autocomplete="off" placeholder="Pin Code *" required>
                                  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    	<label>Present Address  </label>
                                       <textarea name="present_address" autocomplete="off" placeholder="Present Full address " style="border-bottom: 1px solid rgba(119,119,119,1);
                                          height: 100px; resize:none;" required></textarea>
                                    </div>
                                 </div>
                              </div>
                           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <h2>Permanent Address</h2>
                                 <div class="container1 row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>State</label>
                                       <select  name="permanent_state" onChange="get_city1(this.value);" class="form-group" required>
                                          <option value="">-- State --</option>
                                          <?php 
										  $state=$mysqli->query("SELECT * FROM `state` ORDER BY `state_name` ASC");
										  if($state->num_rows>0)
										  {
											  while($state_res=$state->fetch_assoc())
											  {
										  ?>
                                          <option value="<?php echo $state_res['state_id'];?>"><?php echo $state_res['state_name'];?></option>
                                          <?php }}?>
                                       </select>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                       <label>City</label>
                                       <select  name="permanent_city" id="city1" class="form-group" required>
                                          <option>-- City --</option>
                                       </select>
                                  </div>
                                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                       <label>Region</label>
                                       <input type="text" autocomplete="off" name="permanent_region" placeholder=" Region *" required>
                                  </div>
                                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                       <label>Pin Code</label>
                                       <input type="text" autocomplete="off" name="permanent_pin_code" placeholder="Pin Code *" required>
                                  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    	<label>Present Address  </label>
                                       <textarea name="permanent_address" autocomplete="off" placeholder="Present Full address " style="border-bottom: 1px solid rgba(119,119,119,1); height: 100px; resize:none;" required></textarea>
                                    </div>
                                 </div>
                              </div>
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                  <ul class="list-inline">
                                     <li><a href="#"><input type="checkbox" style="margin-left: 10px;height: 15px;width: 15px;" required></a></li>
                                     <li><a href="#"> <label  style="margin-top: 12px;">
                                       Terms and condition 
                                       </label></a></li>
                                   </ul>
                              </div>
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                 <button type="submit" name="add_service_provider" class="theme-btn btn-style">Submit</button>
                              </div>
                           </form>
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
           <link rel="stylesheet" href="https://www.aafilogicinfotech.com/demo/active-baccha/admin/plugins/select2/select2.min.css">
      <script src="https://www.aafilogicinfotech.com/demo/active-baccha/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://www.aafilogicinfotech.com/demo/active-baccha/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="https://www.aafilogicinfotech.com/demo/active-baccha/admin/plugins/select2/select2.full.min.js"></script>

      <script src="https://www.aafilogicinfotech.com/demo/active-baccha/admin/plugins/select2/select2.full.min.js"></script>
      
      
 <script>
  $(function () {
    $('.select2').select2()
  });
</script>

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
   $('<li class="sent"><img src="https://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
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