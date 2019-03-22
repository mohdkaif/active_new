
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
      <div class="form-group col-md-6">
        <label for="email">Mobile:</label>
        <input type="text" name="mobile" placeholder=" Mobile number *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Email:</label>
        <input type="text" name="email" placeholder="Email *" class="form-control" >
      </div>

      <div class="form-group col-md-6">
        <label for="email">Date Of Birth:</label>
        <input type="date" name="date_of_birth" placeholder="Date Of Birth *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Address:</label>
          <textarea name="permanent_address" placeholder="Address" class="form-control"></textarea>
      </div>
      <div class="form-group col-md-6">
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
      <div class="form-group col-md-6">
        <label for="pwd">State:</label>
        <select class="form-control" name="state" id="state" style="height: 45px;" >
          <option value="">Select State</option>
       
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">City:</label>
        <select class="form-control" name="city" id="city" style="height: 45px;" >
          <option value="">Select City</option>
            {{-- @if(!empty($country))
               @foreach($country as $countries)
                  <option value="{{$countries->id}}">{{$countries->country_name}}</option>
               @endforeach
            @endif --}}
        </select>
      </div>

      <div class="form-group col-md-6">
        <label for="email">Password:</label>
         <input type="password" name="password" placeholder=" Password *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Confirm Password:</label>
         <input type="password" name="confirm_password" placeholder=" Verify Password *" class="form-control">
      </div>

      <div class="form-group col-md-6">
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

       <div class="form-group col-md-6">
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


      <div class="form-group col-md-6">
        <label for="email">Bank Name:</label>
        <input type="text" name="bank_name" placeholder="Bank Name *" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Bank Account Number:</label>
        <input type="text" name="bank_account_number" placeholder="Bank account Number *" >
      </div>

      <div class="form-group col-md-6">
        <label for="email">Bank Holder name:</label>
         <input type="text" name="bank_holder_name" placeholder=" Bank Holder Name *" >
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Bank IFSC Code:</label>
         <input type="text" name="bank_ifsc_code" placeholder=" Bank IFSC Code *" >
      </div>
      <div class="form-group col-md-6">
        <label for="email">Graduation Document:</label>
        <input type="file" name="document_graduation">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Post Graduation Document:</label>
        <input type="file" name="document_post_graduation">
      </div>

      <div class="form-group col-md-6">
        <label for="email">Adhar Card:</label>
          <input type="file" name="document_adhar_card" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <label for="pwd">Other Document:</label>
         <input type="file" name="document_other"  class="form-control">
      </div>
      <input type="hidden" name="type" value="provider">
      
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="yes" name="term_condition">Term And Condition</label>
    </div>
    <button type="button" data-request="ajax-submit" data-target='[role="provider-signup"]' class="theme-btn btn-style">Submit</button>
  </form>
</div>