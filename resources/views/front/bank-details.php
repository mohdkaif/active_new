<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
if($_SESSION['service_provider_id']=='')
{
	header('Location: login.php');
}

$provider=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
$provider_res=$provider->fetch_assoc();

if(isset($_POST['add_bank']))
{
	//echo '<pre>';
	//print_r($_POST);exit;
	if($_POST['bank_name']<>'' && $_POST['account_holder_name']<>'' && $_POST['bank_account_number']<>'' && $_POST['ifsc_code']<>'' && $_POST['branch_name']<>'')
	{
		$res=$mysqli->query("INSERT INTO `bank_account`(`service_provider_id`, `account_holder_name`, `bank_name`, `bank_account_number`, `ifsc_code`, `branch_name`, `account_add_time`) VALUES ('".$_SESSION['service_provider_id']."','".addslashes($_POST['account_holder_name'])."','".addslashes($_POST['bank_name'])."','".addslashes($_POST['bank_account_number'])."','".addslashes($_POST['ifsc_code'])."','".addslashes($_POST['branch_name'])."','".$date."')");
		
		if($res)
		{
			$msg='<div class="alert alert-success"><strong>Thank You!</strong> Bank add successfully saved.</div>';
		}
		else
		{
			$msg='<div class="alert alert-danger"><strong>Oh snap!</strong> something went wrong.</div>';
		}
	}
}

if(isset($_POST['edit_bank']))
{
	//echo '<pre>';
	//print_r($_POST);exit;
	if($_POST['bank_name']<>'' && $_POST['account_holder_name']<>'' && $_POST['bank_account_number']<>'' && $_POST['ifsc_code']<>'' && $_POST['branch_name']<>'')
	{
		
		$res=$mysqli->query("UPDATE `bank_account` SET `account_holder_name`='".addslashes($_POST['account_holder_name'])."',`bank_name`='".addslashes($_POST['bank_name'])."',`bank_account_number`='".addslashes($_POST['bank_account_number'])."',`ifsc_code`='".addslashes($_POST['ifsc_code'])."',`branch_name`='".addslashes($_POST['branch_name'])."' WHERE `bank_account_id`='".addslashes($_POST['bank_account_id'])."' and `service_provider_id`='".$_SESSION['service_provider_id']."'");
		
		if($res)
		{
			$msg='<div class="alert alert-success"><strong>Thank You!</strong> Bank update successfully saved.</div>';
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
body .modal-backdrop.in {
  transition: all 0.4s;
    filter: alpha(opacity=1);
    opacity: 1;
    background-color: #fff;
}
.contactPopupPanel{
  border-radius: 0px;
}

.contactPopupPanel .modal-content{
  border-radius: 0px;
  background: #fff;
  max-width: 700px;
  margin: auto;
  box-shadow: none;
  border: none;
}

body .modal-backdrop.in {
  transition: all 0.4s;
    filter: alpha(opacity=1);
    opacity: 1;
    background-color: #fff;
}
.contactPopupPanel .modal-content .modal-body{
  padding: 20px 30px;
}
#wrapper .contactPopupPanel .modal-content .ht3{
  color: #333;
  text-transform: uppercase;
}
#wrapper .contactPopupPanel .modal-content .ht6{
  margin-bottom: 20px;
  color: #333;
}  
.contactPopupPanel .modal-content .modal-header .close {
    margin-top: -4px;
    font-size: 40px;
    color: #3db8b7 !important;
    opacity: 4;
}
.contactPopupPanel .modal-content .form-group{
  margin-bottom: 20px;
}
.contactPopupPanel .modal-content label{
  font-weight: 300;
  margin: 0px;
}
.contactPopupPanel .modal-content .contactSub{
  margin-top: 0;
  line-height: normal;
  font-weight: 500;
  font-size: 17px;
  
  color: #fff;
  background: #e96036;
  text-transform: uppercase;
  
  height: inherit;
}
.contactPopupPanel .modal-content .contactSub:hover{
  margin-top: 0;
  line-height: normal;
  font-weight: 500;
  font-size: 17px;
  text-transform: uppercase;
  background: #3db8b7;
  color: #fff;
  height: inherit;
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
         <!--Main Slider-->
        <section class="page-title" style="background: #31697f; height: 300px">
         
            <div class="auto-container">
               
       <h1 style="color:#f0eeee;">Welcome <span class="text-sky" style="color: #e88060!important;">  <?php echo $provider_res['service_provider_fname'].' '.$provider_res['service_provider_lname'];?></span></h1>
            </div>
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
                <div class="row" style="padding: 10px;border: 1px solid #f6f6f6;padding: 15px;    background: #fff;box-shadow: aliceblue;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                 
                    <div class="table-responsive ">
                         <table class="table table-bordered" >
                            <tr>
                                 <td><p>Bank Details</p></td>
                                <td>
<a href="#add_bank_detail" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-default pull-right">Add Bank details</a>
                                </td>
                                
                            </tr>
                         </table>
                        <table class="table table-bordered"  style="padding: 15px;    background: #fff;box-shadow: aliceblue;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <thead>
                                <tr >
                                	<th class="text-center">Bank Name</th>
                                    <th class="text-center">Account Number </th>
                                    <th class="text-center">IFSC Code</th>
                                    <th class="text-center">Account Holder Name </th>
                                    <th class="text-center">Branch Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
							$bank=$mysqli->query("SELECT * FROM `bank_account` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
							if($bank->num_rows>0)
							{
								while($bank_res=$bank->fetch_assoc())
								{
							?>
                                <tr id="sessiondiv<?php echo $bank_res['bank_account_id'];?>">
                                <td class="text-center"><?php echo $bank_res['bank_name'];?></td>
                                <td class="text-center"><?php echo $bank_res['bank_account_number'];?></td>
                                <td class="text-center"><?php echo $bank_res['ifsc_code'];?></td>
                                <td class="text-center"><?php echo $bank_res['account_holder_name'];?></td>
                                <td class="text-center"><?php echo $bank_res['branch_name'];?></td>
                                <?php if($bank_res['account_status']=='1'){ ?>
                               <td class="text-center" style="color: #4eb20c">APPROVED</td>
                                <?php }else {?>
                                <td class="text-center" style="color: #e96036">PANDING</td>
                                <?php }?>
                                <td class="text-center">					
                                 <a href="#edit_bank_detail<?php echo $bank_res['bank_account_id'];?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-s1">
                                 <i class="fa fa-pencil"></i></a>
                                 &nbsp 
                                 <a href="javascript:void(o);" onClick="delete_bank(<?php echo $bank_res['bank_account_id'];?>);">
                                 <button class="btn btn-s2"><i class="fa fa-trash"></i></button></a> 
                               </td>
                                </tr>
                                <div id="edit_bank_detail<?php echo $bank_res['bank_account_id'];?>" class="contactPopupPanel modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="ht4 text-center">Edit Bank Details
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </h3>
            </div>
            <div class="modal-body">
            <form method="post" action="">
              <div class="col-md-6">
              <label>Bank Name </label>               
                <div class="form-group">
                  <input type="text" name="bank_name" class="form-control" value="<?php echo $bank_res['bank_name'];?>"  required="required" />
                  <input type="hidden" name="bank_account_id" value="<?php echo $bank_res['bank_account_id'];?>" />
                </div>
              </div>
              <div class="col-md-6">
              <label>Account Holder Name</label>               
                <div class="form-group">
                  <input type="text" name="account_holder_name" class="form-control" value="<?php echo $bank_res['account_holder_name'];?>"  required="required" />
                </div>
              </div>
              <div class="col-md-6">
              <label>Account Number</label>               
                <div class="form-group">
                  <input type="text" name="bank_account_number" class="form-control" value="<?php echo $bank_res['bank_account_number'];?>" required />
                </div>
              </div>
              
              <div class="col-md-6"> 
              <label>IFSC Code</label>              
                <div class="form-group">
                  <input type="text" name="ifsc_code" class="form-control" value="<?php echo $bank_res['ifsc_code'];?>"  required="required" />
                </div>
              </div>
            <div class="col-md-12"> 
              <label>Branch Name</label>              
                <div class="form-group">
                  <input type="text" name="branch_name" class="form-control" value="<?php echo $bank_res['branch_name'];?>" required />
                </div>
              </div>
            
              <div class="col-md-12">    
                <div class="form-group" style="margin-bottom: 0;">
                  <input type="submit" name="edit_bank" class="btn btn-why btn-lg form-control contactSub" value="Submit" />
                </div>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>
                                <?php }}?>
                                 
                            </tbody>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
                
            </div>
              
          </div>
        </div>
    </section>
     


<!-- Modal HTML -->
<div id="add_bank_detail" class="contactPopupPanel modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="ht4 text-center">Bank Details
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </h3>
            </div>
            <div class="modal-body">
            <form method="post" action="">
              <div class="col-md-6">
              <label>Bank Name </label>               
                <div class="form-group">
                  <input type="text" name="bank_name" class="form-control"  required="required" />
                </div>
              </div>
              <div class="col-md-6">
              <label>Account Holder Name</label>               
                <div class="form-group">
                  <input type="text" name="account_holder_name" class="form-control"  required="required" />
                </div>
              </div>
              <div class="col-md-6">
              <label>Account Number</label>               
                <div class="form-group">
                  <input type="text" name="bank_account_number" class="form-control" required />
                </div>
              </div>
              
              <div class="col-md-6"> 
              <label>IFSC Code</label>              
                <div class="form-group">
                  <input type="text" name="ifsc_code" class="form-control"  required="required" />
                </div>
              </div>
            <div class="col-md-12"> 
              <label>Branch Name</label>              
                <div class="form-group">
                  <input type="text" name="branch_name" class="form-control" required />
                </div>
              </div>
            
              <div class="col-md-12">    
                <div class="form-group" style="margin-bottom: 0;">
                  <input type="submit" name="add_bank" class="btn btn-why btn-lg form-control contactSub" value="Submit" />
                </div>
              </div>
              </form>
            </div>
        </div>
    </div>
</div><!-- end of contactPopupPanel -->


     
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