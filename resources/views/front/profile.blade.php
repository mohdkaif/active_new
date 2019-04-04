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
                    <a href="{{url('logout')}}">Logout</a>
                    </div>
                  </div>
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
                @if(!empty($user['image']))
                    <img src="{{url('assets/images/users/'.$user['image'])}}">
                  @else
                    <img src="{{url('assets/images/user.png')}}">
                  @endif
                
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
                    <form role="update" method="post" action="{{url('provider/update-profile')}}" id="contact-form" novalidate>

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label>
                                  First Name
                                
                                
                                </label>
                                <input type="text" name="first_name" placeholder="Full Name *" required="" value="{{!empty($user['first_name'])?$user['first_name']:''}}">
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <label>
                                  Last Name
                                </label>
                                <input type="text" name="last_name" placeholder="Last Name *" required="" value="{{!empty($user['last_name'])?$user['last_name']:''}}">
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label>
                                 E-mail
                                </label>
                                <input type="text" name="email" placeholder="E-mail *" required="" readonly value="{{!empty($user['email'])?$user['email']:''}}">
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <label>
                                 Phone
                                </label>
                                <input type="text" name="mobile" placeholder="Phone *" required="" readonly value="{{!empty($user['mobile'])?$user['mobile']:''}}">
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <label>
                                  Date Of Birth
                                </label>
                                <input type="text" name="date_of_birth" placeholder="Date Of Birth" required="" value="{{!empty($user['date_of_birth'])?$user['date_of_birth']:''}}" class="date">
                            </div>
 


                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label>
                                  Gender
                                </label>
                                <select class="form-control" name="gender">
                                  <option value="">Select Gender</option>
                                  <option value="male" @if(!empty($user['gender']) && $user['gender']=='male') selected @endif>Male</option>
                                  <option value="female" @if(!empty($user['gender']) && $user['gender']=='female') selected @endif>Female</option>
                                   <option value="other" @if(!empty($user['gender']) && $user['gender']=='other') selected @endif>Other</option>
                                </select>
                            </div>


                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>
                                Update Profile Picture
                              </label>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  @if(!empty($user['image']))
                                    <img style="max-width: 100px;" src="{{url('assets/images/providers/'.$user['image'])}}" id="adminimg">
                                  @else
                                    <img style="max-width: 100px;" src="{{asset('assets/images/avatar.png')}}" id="adminimg" alt="No Profile Picture Added">
                                  @endif
                                  
                                </div>
                              </div>
                            </div>

                            


                             {{-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <label>
                                 Photo
                                </label>
                                @if(!empty($user['image']))
                                <img src="{{url('')}}" width="100px" height="100px">
                                @endif
                                <input type="text" name="image" placeholder="Phone *" required="" value="{{!empty($user['mobile'])?$user['mobile']:''}}">
                            </div> --}}

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>Address </label>
                                <textarea name="address" placeholder="Address " style="border-bottom: 1px solid rgba(119,119,119,1);
                                height: 100px">
                                  {{!empty($user['address'])?$user['address']:''}}

                                </textarea>
                            </div>
                           {{--   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>Example file input</label>
                               <input type="file" name="username"  style="border: none;">
                            </div> --}}
                           {{--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <button type="submit" class="theme-btn btn-style">Send Message</button>
                            </div> --}}
                            <button type="button" data-request="ajax-submit" data-target="[role='update']" class="theme-btn btn-style">Update</button>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        </tr>
                      <tr>
                      <td>{{!empty($user['first_name'])?$user['first_name']:''}}</td>
                        <td>{{!empty($user['last_name'])?$user['last_name']:''}}</td>
                        <td>{{!empty($user['email'])?$user['email']:''}}</td>
                      </tr>
                      <tr>
                        <th>Phone</th>
                        <th>Address</th>
                        {{-- <th>Example file input</th> --}}
                        </tr>
                      <tr>
                      <td>{{!empty($user['mobile'])?$user['mobile']:''}}</td>
                        <td>{{!empty($user['address'])?$user['address']:''}}</td>
                     {{--    <td>photo</td> --}}
                      </tr>
                    </table>
                     
                   </div>
                 </div>
                 <div role="tabpanel" class="tab-pane fade" id="Section3">
                      <h2 style="text-align: center;background: #17697e;color: #fff;">Change Password </h2>
                 <br>
                 <div class="contact-formlogin">
                   <form role="change_password" method="post" action="{{url('provider/change-password')}}" id="contact-form" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>
                                 Old Password
                                </label>
                                <input type="password" name="old_password" placeholder=" Old Password *" required="">
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>
                                 New Password
                                </label>
                                <input type="password" name="new_password" placeholder="New Password *" required="">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>
                                 Confirm Password
                                </label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password *" required="">
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                                 <button type="button" data-request="ajax-submit" data-target="[role='change_password']" class="theme-btn btn-style">Update</button>
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
<script type="text/javascript">
   
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adminimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }   
    }
</script>
@endsection
