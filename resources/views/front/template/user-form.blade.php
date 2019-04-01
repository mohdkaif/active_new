<form role="user-signup" method="post" action="{{url('/signup')}}" class="contact-form">
   <input type="hidden" name="type" value="user">
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         First Name
         </label>
         <input type="text" name="first_name" placeholder="First Name *" class="form-control">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Last Name
         </label>
         <input type="text" name="last_name" placeholder="Last Name *" class="form-control">
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
         <h2> Child details</h2>
         <div class="container1 row">
            <div  class="col-md-6 form-group">
               <input type="hidden" name="child_name" class="form-control">
            </div>
            <div  class="col-md-6 form-group">
               <input type="hidden" name="child_age" class="form-control">
            </div>
            <div  class="col-md-6 form-group">
              <input type="hidden" name="child_gender" class="form-control">
            </div>
            
            
         </div>
         <div class="container1 row">
            
            <div  class="col-md-6 form-group">
               <label>Name</label>
               <input type="text" name="child_name[0]" placeholder="Name *" class="form-control">
            </div>
            <div  class="col-md-6 form-group" >
               <label> Age</label>
               
               <select  name="child_age[0]" class="sele">
                     <option value="">--Age--</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                     <option value="11">11</option>
                     <option value="12">12</option>
               </select>
            </div>
            
            <div  class="col-md-6 form-group">
               <label> Gender</label>
              
               <ul class="list-inline">
                  <li><label class="radio">Male
                     <input type="radio" name="child_gender[0]" value="male" checked="" class="form-control">
                     <span class="checkround"></span>
                     </label>
                  </li>
                  <li><label class="radio">Female
                     <input type="radio" name="child_gender[0]" value="female" class="form-control">
                     <span class="checkround"></span>
                     </label></a>
                  </li>
                  <li><label class="radio">Other
                     <input type="radio" name="child_gender[0]" value="other" class="form-control">
                     <span class="checkround"></span>
                     </label>
                  </li>
               </ul>
            </div>
         </div>
         <div  id="child-more"></div>
         <div  class="row form-group">
            <button type="button" data-request="add-another" data-target="#child-more" data-url="{{url('add-more-child')}}" data-count="1" class="add_form_field btn-style">+ Add More</button>
      </div>
      </div>
      
      
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Mobile number
         </label>
         <input type="text" name="mobile" placeholder=" Mobile number *" class="form-control">
      </div>
     {{--  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         OTP
         </label>
         <input type="password" name="otp" placeholder=" OTP *" >
      </div> --}}
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <h2>Verify mail id</h2>
         <div class="container1 row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
               <label>Address </label>
               <textarea name="address" class="form-control" placeholder="Address" style="border-bottom: 1px solid rgba(119,119,119,1);
                  height: 100px"></textarea>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
               <label for="email">Region:</label>
       
               <select class="form-control" name="country" id="country" style="height: 45px;" >
                  <option value="">Select Region</option>
                     @if(!empty($country))
                        @foreach($country as $countries)
                           <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                        @endforeach
                     @endif
               </select>
            </div>
             <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               State 
               </label>
               <select class="form-control" name="state" id="state" style="height: 45px;" >
                  <option value="">Select State</option>
                  {{--  @if(!empty($country))
                     @foreach($country as $countries)
                        <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                     @endforeach
                  @endif --}}
               </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               City 
               </label>
               <select class="form-control" name="city" id="city" style="height: 45px;" >
                  <option value="">Select City</option>
                  {{-- @if(!empty($country))
                     @foreach($country as $countries)
                        <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                     @endforeach
                  @endif --}}
              </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               Password
               </label>
               <input type="password" name="password" placeholder=" Password *" class="form-control">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               Verify Password
               </label>
               <input type="password" name="confirm_password" placeholder=" Verify Password *" class="form-control">
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
         <button type="button" data-request="ajax-submit" data-target='[role="user-signup"]' class="theme-btn btn-style">Submit</button>
      </div>
   </form>
