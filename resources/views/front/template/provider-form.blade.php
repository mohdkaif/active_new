<div class="container">
  <h2>Personal Information</h2>
  <form role="provider-signup" method="post" action="{{url('/signup')}}" >
    <div class="row">
      <div class="form-group col-md-6">
        <label for="email">First Name:</label>
        <input type="text" name="first_name" placeholder="First Name *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Last Name:</label>
        <input type="text" name="last_name" placeholder="Last Name *" class="form-control">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="email">Mobile:</label>
        <input type="text" name="mobile" placeholder=" Mobile number *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Email:</label>
        <input type="text" name="email" placeholder="Email *" class="form-control" >
      </div>
    </div> 

    <div class="row">
      <div class="form-group col-md-6">
        <label for="email">Date Of Birth:</label>
        <input type="date" name="date_of_birth" placeholder="Date Of Birth *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Address:</label>
        <textarea name="address" placeholder="Address" class="form-control"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="email">Region:</label>
        <div class="input-group">
          <select class="" name="country" id="country" style="height: 45px;" >
            <option value="">Select Region</option>
              @if(!empty($country))
                 @foreach($country as $countries)
                    <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                 @endforeach
              @endif
          </select>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">State:</label>
        <div class="input-group">
          <select class="" name="state" id="state" style="height: 45px;" >
            <option value="">Select State</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="pwd">City:</label>
        <div class="input-group">
 
          <select class="" name="city" id="city" style="height: 45px;" >
            <option value="">Select City</option>
              {{-- @if(!empty($country))
                 @foreach($country as $countries)
                    <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                 @endforeach
              @endif --}}
          </select>
        </div>
     
      </div>
       <div class="form-group col-md-6">
        <label for="pwd">Pincode:</label>
        <input type="text" name="pincode" placeholder=" Pincode" class="form-control">
      </div>

     
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="pwd">Gender:</label>
        <div class="input-group">
 
          <select class="" name="gender" id="gender" style="height: 45px;" >
            <option value="">Select Gender</option>
              <option value="female">Female</option>
               <option value="male">Male</option>
               <option value="other">Other</option>
          </select>
        </div>
     
      </div>


     
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="email">Password:</label>
        <input type="password" name="password" placeholder=" Password *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Confirm Password:</label>
        <input type="password" name="confirm_password" placeholder=" Verify Password *" class="form-control">
      </div>

      {{-- div class="form-group col-md-6">
        <label for="pwd">Price Per Hour:</label>
         <input type="text" name="price_per_hour" placeholder=" Price Per Hour *" class="form-control">
      </div>
        <div class="form-group col-md-6">
        <label for="pwd">Price Per Children:</label>
         <input type="text" name="price_per_children" placeholder="Price Per Children *" class="form-control">
      </div>

      <div class="form-group col-md-6">
        <label for="pwd">Experience In Work:</label>
         <input type="text" name="experience_in_work" placeholder="Experience In Work *" class="form-control">
      </div>
 --}}
      {{--  <div class="form-group col-md-6">
        <label for="pwd">Service:</label>
        <select class="form-control" name="service_id" id="service_id" style="height: 45px;" >
          <option value="">Select Service</option>
            @if(!empty($services))
               @foreach($services as $service)
                  <option value="{{$service->service_sub_category_id}}">{{$service->service_sub_category_name}}</option>
               @endforeach
            @endif
        </select>
      </div>

 --}} 
    </div>
    <div class="row">
       
      <div class="col-md-6">
      
          <input type="checkbox" value="yes" name="location_track_permission"> Location Track Permission
        
      </div>
      <div class=" col-md-6" style="margin-bottom: 10px;">
     
        <input type="checkbox" value="yes" id="long_distance_travel_permit" name="long_distance_travel_permit">  Long Distance Travel:
    
        
      </div>
     
    </div>
    <div class="row">
     <div class="form-group col-md-6">
        <label for="pwd">Distance Travel:</label>
        <input type="text" name="distance_travel" placeholder="Distance Travel" class="form-control">

      </div>
      <div class="form-group col-md-6" id="long_d_t_charge" style="display:none">
        <label for="pwd">Long Distance Travel Charges:</label>
      
        <input type="text" name="long_distance_travel" placeholder="Long Distance Travel Charges" class="form-control">
        
      </div>
     
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="email">Bank Name:</label>
        <input type="text" name="bank_name" placeholder="Bank Name *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Bank Account Number:</label>
        <input type="text" name="bank_account_number" placeholder="Bank account Number " >
      </div>

     
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="email">Bank Holder name:</label>
         <input type="text" name="bank_holder_name" placeholder=" Bank Holder Name " >
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Bank IFSC Code:</label>
        <input type="text" name="bank_ifsc_code" placeholder=" Bank IFSC Code " >
      </div>
     
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="pwd">Bank Branch Name:</label>
        <input type="text" name="bank_branch_name" placeholder="Bank Branch Name" >
      </div>
      <div class="form-group col-md-6">
        <label for="email">HighSchool/Inter Document:</label>
        <input type="file" name="document_highschool">
      </div>
     
     
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="email">Graduation Document:</label>
        <input type="file" name="document_graduation">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Post Graduation Document:</label>
        <input type="file" name="document_post_graduation">
      </div>
     
     
      <input type="hidden" name="type" value="provider">
      
    </div>
    <div class="row">
       <div class="form-group col-md-6">
        <label for="email">Adhar Card:</label>
        <input type="file" name="document_adhar_card" class="form-control">
      </div>
       <div class="form-group col-md-6">
        <label for="pwd">Other Document:</label>
        <input type="file" name="document_other"  class="form-control">
      </div>
     
    </div>
    <div class="row">
      <div class="form-group col-md-12">
       
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
           <label for="email">Profile Picture:</label>
          <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file" class="form-control">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <img style="max-width: 250px;margin-top: 30px;" src="{{asset('assets/images/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
        </div>
      </div>
    </div> 
     <div class="row">
     
      <div class="checkbox col-md-6">
        <label><input type="checkbox" value="yes" name="term_condition">Terms And Conditions</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <button type="button" data-request="ajax-submit" data-target='[role="provider-signup"]' class="theme-btn btn-style">Submit</button>
      </div>
    </div>
  </form>
</div>