
         <section class="page-title" style="background: #31697f; height: 300px">
         
            <div class="auto-container">
               
       <h1 style="color:#f0eeee;">Welcome <span class="text-sky" style="color: #e88060!important;">{{\Auth::user()->first_name}} </span></h1>
               
            </div>
         </section>
         <section class="user">
                    <img src="{{url('assets/images/user.png')}}" class="img-circle center-block" >
         </section>
      {!!view('front.dashboard-slider')!!}
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
                                <td class="text-center">{{\Auth::user()->first_name}}</td>
                                <td class="text-center">{{\Auth::user()->email}}</td>
                                <td class="text-center">{{\Auth::user()->mobile}}</td>
                                <td class="text-center">{{\Auth::user()->date_of_birth}}</td>
                                <td class="text-center">{{\Auth::user()->gender}}</td>
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
                               sub category
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
                                <td class="text-center">{{\Auth::user()->state}}</td>
                                <td class="text-center">{{\Auth::user()->city}}</td>
                                <td class="text-center">{{\Auth::user()->country}}</td>
                                <td class="text-center">{{\Auth::user()->state}}</td>
                                <td class="text-center">{{\Auth::user()->address}}</td>
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
                                <td class="text-center">{{\Auth::user()->state}}</td>
                                <td class="text-center">{{\Auth::user()->city}}</td>
                                <td class="text-center">{{\Auth::user()->country}}</td>
                                <td class="text-center">{{\Auth::user()->state}}</td>
                                <td class="text-center">{{\Auth::user()->address}}</td>
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
                                <a href="#edit_education" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-s1"><i class="fa fa-pencil"></i></a>
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
        
 