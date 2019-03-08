<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>demo</title>
      <!-- Stylesheets -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
       <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="css/profile.css">
       <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <!-- REVOLUTION NAVIGATION STYLES -->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
     
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Responsive -->
    
     
   </head>
   <body>
      <div class="page-wrapper">
         <!-- Main Header-->
         <!--End Main Header -->
         <!--Main Slider-->
         <section style="background: #ffff00">
              <header class="">
               <!-- Main Box -->
               <div class="header-lower">
                  <div class="auto-container">
                     <div class="main-box clearfix">
                        <!--Logo Box-->
                        <div class="logo-box col-md-3 col-xs-6" >
                           <div class="logo"><a href="index.html"><img src="images/logo.png" alt="" class="img-responsive"></a></div>
                        </div>
                        <!--Nav Outer-->
                        <div class=" col-md-9 col-xs-6">
                           <!-- Main Menu -->
                           <div class="dropdown pull-right">
                        <button class="dropbtn "><i class='fa fa-user'></i>&nbsp Profile  <span class="caret"></span></button>
                        <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                        </div>
                      </div>

                           <!-- Main Menu End-->
                           <!-- Call btn -->
                        </div>
                     </div>
                  </div>
               </div>
            </header>         
          </section>
      <section class="intro-section">
        <div class="auto-container">
            <div class="row clearfix">
                
                <div class="col-md-12">
               <div class="tab" role="tabpanel">
                  <!-- Nav tabs -->
                  <div class="col-md-3">
                    <img src="images/user.png">
                  <ul class="nav nav-tabs" role="tablist">
                     <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user"></i><br>PROFILE </a></li>
                     <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i><br>HISTORY </a></li>
                     <li role="presentation"><a href="#Section3" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-key"></i><br>CHANGE PASSWORD </a></li>
                      
                       <li role="presentation"><a href="#Section5" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-headphones"></i><br>FEEDBACK </a></li>
                  </ul>
                  </div>
                  <!-- Tab panes -->
                   <div class="col-md-9">
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                       
               <div class="form-column col-md-12 col-sm-12 col-xs-12">
                     <h2 style="text-align: center;background: #17697e;color: #fff;">YOUR PROFILE </h2>
                     <br>
                    <div class="contact-formlogin">
                        <!--Contact Form-->
                        <form method="post" action="#" id="contact-form" novalidate>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>
                                      Full Name
                                    </label>
                                    <input type="text" name="username" placeholder="Full Name *" required="">
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <label>
                                      Last Name
                                    </label>
                                    <input type="text" name="username" placeholder="Last Name *" required="">
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>
                                     E-mail
                                    </label>
                                    <input type="text" name="username" placeholder="E-mail *" required="">
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <label>
                                     Phone
                                    </label>
                                    <input type="text" name="username" placeholder="Phone *" required="">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>Public Info </label>
                                    <textarea name="message" placeholder="Public Info " style="border-bottom: 1px solid rgba(119,119,119,1);
                                    height: 100px"></textarea>
                                </div>
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>Example file input</label>
                                   <input type="file" name="username"  style="border: none;">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="submit" class="theme-btn btn-style">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="Section2">
                       <h2 style="text-align: center;background: #17697e;color: #fff;">History</h2>
                       <br>
                       <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <th>Full Name</th>
                            <th>Last Name</th>
                            <th>E-mail</th>
                            </tr>
                          <tr>
                          <td>mukesh</td>
                            <td>maurya</td>
                            <td>mukeshmaurya@gamil.com</td>
                          </tr>
                          <tr>
                            <th>Phone</th>
                            <th>Public Info</th>
                            <th>Example file input</th>
                            </tr>
                          <tr>
                          <td>00000000</td>
                            <td>abc</td>
                            <td>photo</td>
                          </tr>
                        </table>
                         
                       </div>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="Section3">
                          <h2 style="text-align: center;background: #17697e;color: #fff;">Change Passward </h2>
                     <br>
                     <div class="contact-formlogin">
                       <form method="post" action="#" id="contact-form" novalidate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>
                                     Old Password
                                    </label>
                                    <input type="password" name="password" placeholder=" Old Password *" required="">
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>
                                     New Password
                                    </label>
                                    <input type="password" name="password" placeholder="New Password *" required="">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>
                                     Confirm Password
                                    </label>
                                    <input type="password" name="password" placeholder="Confirm Password *" required="">
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                                    <button type="submit" class="theme-btn btn-style">Login</button>
                                </div>
                               
                            </div>
                        </form>
                     </div>
                     </div>
                     
                      <div role="tabpanel" class="tab-pane fade" id="Section5">
                         <h2 style="text-align: center;background: #17697e;color: #fff;">FEEDBACK </h2>
                     <br>
                    <div class="contact-formlogin">
                        <!--Contact Form-->
                        <form method="post" action="#" id="contact-form" novalidate>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>
                                      Full Name
                                    </label>
                                    <input type="text" name="username" placeholder="Full Name *" required="">
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <label>
                                      Last Name
                                    </label>
                                    <input type="text" name="username" placeholder="Last Name *" required="">
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>
                                     E-mail
                                    </label>
                                    <input type="text" name="username" placeholder="E-mail *" required="">
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <label>
                                     Phone
                                    </label>
                                    <input type="text" name="username" placeholder="Phone *" required="">
                                </div>
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                 <form id="ratingsForm">
                                <div class="stars pull-left">
                                  <input type="radio" name="star" class="star-1" id="star-1" />
                                  <label class="star-1" for="star-1">1</label>
                                  <input type="radio" name="star" class="star-2" id="star-2" />
                                  <label class="star-2" for="star-2">2</label>
                                  <input type="radio" name="star" class="star-3" id="star-3" />
                                  <label class="star-3" for="star-3">3</label>
                                  <input type="radio" name="star" class="star-4" id="star-4" />
                                  <label class="star-4" for="star-4">4</label>
                                  <input type="radio" name="star" class="star-5" id="star-5" />
                                  <label class="star-5" for="star-5">5</label>
                                  <span></span>
                                </div>
                                
                              </form>
                                </div>
                                 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                  <label>Public Info </label>
                                    <textarea name="message" placeholder="Public Info " style="border-bottom: 1px solid rgba(119,119,119,1);
                                    height: 100px"></textarea>
                                </div>
                                 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="submit" class="theme-btn btn-style-one">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                     <p></p>
                     </div>
                  </div>

               </div>
               </div>
            </div>

                 
            </div>
        </div>
    </section>
    
    <footer class="main-footer">
          
            <div class="background">
               <div class="layer">
               </div>
               <div class="auto-container" >
                  <!--Widgets Section-->
                  <div class="widgets-section">
                     <div class="row clearfix">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 offset-md-3 footer">
                       <h3>“If you want to customise any of our events, workshops & 
packages feel free to ping us .We also organise birthday
 parties in a different & unique manner.”</h3><br>
 <p style="font-family: 'Bradley Hand ITC'">-YOU WISH IT WE PLAN IT….</p><br>
 <button class="btn-style-five center-block" >Contact Us </button>
 </div>
                        
                     </div>
                  </div>
               </div>
            </div>
            <!--Footer Bottom-->
            <div class="footer-bottom">
               <div class="auto-container">
                  <div class="clearfix">
                     <div class="copyright-text">
                        <p> 2019 <a href="#"> 
                           </a> All Rights Reserved.
                        </p>
                     </div>
                     <ul class="footer-links clearfix">
                        <li><a href="#">About  
                           </a>
                        </li>
                        <li><a href="#">Tearm & Conditions   
                           </a>
                        </li>
                         <li><a href="#">Help  
                           </a>
                        </li>
                         <li><a href="#">  Privacy Policy  
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </footer>
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