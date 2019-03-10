<form role="user-signup" method="post" action="{{url('/signup')}}" >
   <input type="hidden" name="type" value="user">
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         First Name
         </label>
         <input type="text" name="first_name" placeholder="First Name *" >
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Last Name
         </label>
         <input type="text" name="last_name" placeholder="Last Name *" >
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <h2> Child details</h2>
         <div class="container1 row">
            <div  class="col-md-6 form-group">
               <label>Name</label>
               <input type="text" name="child_name[]" placeholder="Name *">
            </div>
            <div  class="col-md-6 form-group">
               <label> Age</label>
               <select  name="child_age[]" class="sele">
                  <option value="">--Age--</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
               </select>
            </div>
            <div class="clearfix"></div>
            <div  class="col-md-6 form-group">
               <label> Gender</label>
               <ul class="list-inline">
                  <li><label class="radio">Male
                     <input type="radio" name="child_gender[]" value="male" checked="">
                     <span class="checkround"></span>
                     </label>
                  </li>
                  <li><label class="radio">Female
                     <input type="radio" name="child_gender[]" value="female">
                     <span class="checkround"></span>
                     </label></a>
                  </li>
                  <li><label class="radio">Other
                     <input type="radio" name="child_gender[]" value="other">
                     <span class="checkround"></span>
                     </label>
                  </li>
                  
                  <li class="pull-right"><button type="button" data-request="add-another" data-target="#child-more" data-url="{{url('add-more-child')}}" data-count="1" class="add_form_field btn-style">+ Add More</button></li>
               </ul>
               <div>
               </div>
            </div>
         </div>
         <div id="child-more"></div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Mobile number
         </label>
         <input type="text" name="mobile" placeholder=" Mobile number *" >
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         OTP
         </label>
         <input type="password" name="otp" placeholder=" OTP *" >
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <h2>Verify mail id</h2>
         <div class="container1 row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
               <label>Address </label>
               <textarea name="address" placeholder="Address" style="border-bottom: 1px solid rgba(119,119,119,1);
                  height: 100px"></textarea>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
               <label>
               Region
               </label>
               <input type="text" name="region" placeholder=" Region *" >
            </div>
             <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               State 
               </label>
               <select  name="state" class="form-group">
                  <option value="">-- State --</option>
                  @if(!empty($state))
                     @foreach($state as $states)
                        <option value="{{$states->state_id}}">{{$states->state_name}}</option>
                     @endforeach
                  @endif
                 
               </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               City 
               </label>
               <select  name="city" class="form-group">
                  <option value="">-- City --</option>
                  <option value="">Delhi</option>
               </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               Password
               </label>
               <input type="password" name="password" placeholder=" Password *" >
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
               <label>
               Verify Password
               </label>
               <input type="password" name="confirm_password" placeholder=" Verify Password *" >
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
