@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/profile.css')}}">
@endsection
<section style="background: #ffff00">
      <header class="">
       <!-- Main Box -->
       <div class="header-lower">
          <div class="auto-container">
             <div class="main-box clearfix">
                <!--Logo Box-->
                <div class="logo-box col-md-3 col-xs-6">
                   <div class="logo"><a href="index.html"><img src="images/logo.png" alt="" class="img-responsive"></a></div>
                </div>
                <!--Nav Outer-->
                <div class=" col-md-9 col-xs-6">
                   <!-- Main Menu -->
                   <div class="dropdown pull-right">
                <button class="dropbtn "><i class="fa fa-user"></i>&nbsp; Profile  <span class="caret"></span></button>
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
                <img src="{{url('assets/images/user.png')}}">
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
 
@section('requirejs')
@endsection
