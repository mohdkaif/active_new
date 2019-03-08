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
               <?php include_once("include/header.php") ?>
        
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
                         <table class="table">
                            <tr>
                                 <td><h3>Qualification</h3></td>
                            </tr>
                         </table>
                         <form method="post" action="#" id="contact-form" >
                         
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label style="color: #000">
                                Xth year
                                 </label>
                                 <input type="text" name=""  required="" placeholder="Xth year">
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label style="color: #000">
                                 Graduation Year
                                 </label>
                                 <input type="text" name=""  required="" placeholder="Graduation Year">
                              </div>
                               <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <label style="color: #000">
                                 Post Graduation year
                                 </label>
                                 <input type="text" name=""  required="" placeholder="Post Graduation year">
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label style="color: #000">
                                 XIIth year
                                 </label>
                                 <input type="text" name=""  required="" placeholder="XIIth year">
                              </div>
                              
                              <div class="col-md-5 col-sm-5 col-xs-12 form-group">

                                 <label style="color: #fff;margin-top: 10px;">
                                 Last Namerg rghwri  
                                 </label>
                                 <button type="submit" value="" class="btn btn-default3 pull-left" style="background: #3db8b7;border-radius: unset;">Submit</button> 
                              </div>
                          </form>
                        
                    </div>
                    
                </div>
            </div>
                
            </div>
              
          </div>
        </div>
    </section>
 <?php include_once("include/footer.php") ?>
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