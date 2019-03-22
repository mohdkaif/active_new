  <form role="provider-signup" method="post" action="{{url('/signup')}}" >
    <input type="hidden" name="type" value="provider">
    <div class="container1 row">
       <h2> Personal Information</h2>
       <div class="col-md-12 col-sm-12 col-xs-12">
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
      </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
           <label>
           Mobile number
           </label>
           <input type="text" name="mobile" placeholder=" Mobile number *" class="form-control">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
           <label>
          Email
           </label>
           <input type="text" name="email" placeholder="Email *" class="form-control" >
        </div>
         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <label>
          Date of Birth
           </label>
           <input type="date" name="date_of_birth" placeholder="Date Of Birth *" class="form-control">
        </div>
       
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
           <label>Address </label>
           <textarea name="permanent_address" placeholder="Address" class="form-control"></textarea>
        </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <label>
         Country
         </label>
        {{--  <input type="text" name="country" placeholder=" country *" class="form-control" > --}}
         <select  name="country" class="form-control country" id="country">
            <option value="">Select Country</option>
            @if(!empty($country))
               @foreach($country as $countries)
                  <option value="{{$countries->id}}">{{$countries->country_name}}</option>
               @endforeach
            @endif
         </select>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 ">
       <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         State 
         </label>
         <select  name="state" class="form-control" id="state">
            <option value="">Select State</option>
            {{-- @if(!empty($state))
               @foreach($state as $states)
                  <option value="{{$states->id}}">{{$states->state_name}}</option>
               @endforeach
            @endif --}}
         </select>
       </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         City 
         </label>
         <select id="city" name="city" class="form-control">
            <option value="">Select City</option>
           {{--  <option value="delhi">Delhi</option> --}}
         </select>
      </div>
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
    <div class="col-md-12 col-sm-12 col-xs-12">   
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Bank Name
         </label>
         <input type="text" name="bank_name" placeholder="Bank Name *" class="form-control">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Bank Account Number
         </label>
         <input type="text" name="bank_account_number" placeholder="Bank account Number *" >
      </div>
    </div>
  <div class="col-md-12 col-sm-12 col-xs-12">  
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Bank Holder Name
         </label>
         <input type="text" name="bank_holder_name" placeholder=" Bank Holder Name *" >
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
        Bank IFSC Code
         </label>
         <input type="text" name="bank_ifsc_code" placeholder=" Bank IFSC Code *" >
      </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">  
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
        Graduation Document
         </label>
         <input type="file" name="document_graduation">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
         Post Graduation Document
         </label>
         <input type="file" name="document_post_graduation">
      </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">  
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
        Adhar Card
         </label>
         <input type="file" name="document_adhar_card" class="form-control">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group">
         <label>
        Other Document
         </label>
         <input type="file" name="document_other"  class="form-control">
      </div>
    </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
          <ul class="list-inline">
             <li><a href="#"><input type="checkbox" value="yes" name="term_condition" style="margin-left: 10px;height: 15px;width: 15px;"></a></li>
             <li><a href="#"> <label  style="margin-top: 12px;">
               Terms and condition 
               </label></a></li>
           </ul>
      </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
       <button type="button" data-request="ajax-submit" data-target='[role="provider-signup"]' class="theme-btn btn-style">Submit</button>
    </div>
    </div>
  </form>
  @section('requirejs')
  <script>
     $("#country").change(function () {
        alert('csd');
        $("#state").html('<option value="">Select State</option>');
        $("#state").attr('disabled',true);
        $("#city").html('<option value="">Select City</option>');
        $("#city").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/states/list/?country_id='+mainid, function(response){
            $("#state").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#state").append('<option value="'+data.id+'">'+data.state_name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });
    $("#state").change(function () {
        $("#city").html('<option value="">Select City</option>');
        $("#city").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/cities/list/?state_id='+mainid, function(response){
            $("#city").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#city").append('<option value="'+data.id+'">'+data.city_name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });
  </script>
  @endsection
