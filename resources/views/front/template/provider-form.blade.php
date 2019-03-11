<form role="" method="post" action="{{url('/signup')}}" enctype="multipart/form-data" id="contact-form"/>
<input type="hidden" name="type" value="provider">
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

      <option value="">sd</option>
     
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
             <select id="state" name="present_state" class="form-group" onChange="get_city(this.value);" required>
                <option value="">-- State --</option>
              
                @if(!empty($state))
                   @foreach($state as $states)
                      <option value="{{$states->id}}">{{$states->state_name}}</option>
                   @endforeach
                @endif
               
             </select>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
             <label>City</label>
             <select name="present_city" id="city" class="form-group" required>
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
             <select id="state1" name="permanent_state" onChange="get_city1(this.value);" class="form-group" required>
                <option value="">-- State --</option>
               
                @if(!empty($state))
                   @foreach($state as $states)
                      <option value="{{$states->id}}">{{$states->state_name}}</option>
                   @endforeach
                @endif
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
       <button type="button" data-request="ajax-submit" data-target='[role="user-signup"]'  class="theme-btn btn-style">Submit</button>
    </div>
 </form>