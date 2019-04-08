  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add  Service Providers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> Service Providers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
                
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
               Add Details
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm"
                        data-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool btn-sm"
                        data-widget="remove"
                        data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
         
            <div class="card-body">
                <form  method="POST" enctype="multipart/form-data" role="add" action="{{url('admin/provider')}}">
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image</label><br/>
                         <input type="file" name="image" onchange="imagePreview(this, '#image1');">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>
                           
                              <img id="image1" height="200px;" width="250px;">
                           
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>First Name</label>
                           <input type="text" id="first_name" autocomplete="off" name="first_name" placeholder="First Name *"  class="form-control" >
                      </div>
                      <input type="hidden" name="type" value="provider">
                      <div class="form-group">
                        <label>Phone number</label>
                           <input type="text" name="mobile" id="service_provider_phone" autocomplete="off" placeholder=" Phone number *" class="form-control">
                      </div>
                       <div class="form-group">
                        <label>Date of birth</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                               <input type="text" class="form-control" name="date_of_birth" autocomplete="off" id="start_datepicker" placeholder="DD-MM-YY" >
                         </div>
                      </div>
                      
                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                           <input type="text" id="last_name"  autocomplete="off" name="last_name" placeholder="Last Name *" class="form-control" >
                      </div>
                     

                      {{--  <div class="form-group">
                          <label>Specialization</label>
                          <select class="form-control select2" name="specialization[]" multiple="multiple" data-placeholder="Select Specialization" style="width: 100%;" >
                                <option value="">Optin</option>
                          </select>
                        </div> --}}

                      <div class="form-group">
                        <label>Email</label>
                           <input type="email"  id="service_provider_email" name="email" autocomplete="off" placeholder=" Email *"  class="form-control" >
                      </div>
                       
                     

                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Distance Travel</label>
                           <input type="text" id="last_name"  autocomplete="off" name="distance_travel" placeholder="Distance Travel " class="form-control" >
                      </div>
                     
                      <div class="checkbox col-md-6">
                        <label></label><input type="checkbox" value="yes" name="location_track_permission">Location Track Permission
                      </div>
                      
                     

                    </div>
                    <div class="col-md-6">
                      
                      <div class="checkbox col-md-6">
                     
                        <label></label><input type="checkbox" value="yes" id="long_distance_travel_permit" name="long_distance_travel_permit">Long Distance Travel:
                    
                        
                      </div>
              
                          <div class="form-group" id="long_d_t_charge" style="display:none">
                            <label for="pwd">Long Distance Travel Charges:</label>
                          
                            <input type="text" name="long_distance_travel" placeholder="Long Distance Travel Charges" class="form-control">
                            
                          </div>
                      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5><b>Present Address</b></h5>
                      </div>
                      <div class="form-group">
                        <label for="email">Region:</label>
                        <div class="input-group">
                          <select class="" name="country" id="country" style="height: 45px;" >
                            <option value="">Select Region</option>
                              @if(!empty($country))
                                 @foreach($country as $countries)
                                    <option  value="{{$countries->id}}">{{$countries->country_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="pwd">State:</label>
                        <div class="input-group">
                          <select class="" name="state" id="state" style="height: 45px;" >
                            <option value="">Select State</option>
                           
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <div class="input-group">
                          <select class="" name="city" id="city" style="height: 45px;" >
                            <option value="">Select City</option>
                             
                          </select>
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label>Present Address</label> <!-- <lable class="pull-right"><input type="checkbox"  name="same_address">&nbsp;<b>Same Permanent Address</b></lable> -->
                           <textarea name="address" id="address"  autocomplete="off" placeholder="&nbsp;&nbsp;Present Full address" style="resize: none;" rows="4" cols="70"></textarea>
                      </div>

                    </div>

                    

                    <div class="col-md-6">
                      <div class="form-group">
                            <h5><b>Permanent  Address</b></h5>
                      </div>
                    <div class="form-group">
                        <label for="email">Region:</label>
                        <div class="input-group">
                          <select class="" name="permanent_country" id="permanent_country" style="height: 45px;" >
                            <option value="">Select Region</option>
                              @if(!empty($country))
                                 @foreach($country as $countries)
                                    <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pwd">State:</label>
                        <div class="input-group">
                          <select class="" name="permanent_state" id="permanent_state" style="height: 45px;" >
                            <option value="">Select State</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                         <div class="input-group">
 
                          <select class="" name="permanent_city" id="permanent_city" style="height: 45px;" >
                            <option value="">Select City</option>
                            
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>Permanent Address</label>
                        
                           <textarea  name="permanent_address" id="permanent_address"  placeholder="&nbsp;&nbsp;Permanent Full address" style="resize:none;"  rows="4" cols="70">
                           
                           </textarea>
                      
                      </div>
                       <div class="form-group">
                        <label for="email">Password:</label>
                        <input type="password" name="password" placeholder=" Password *" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" name="confirm_password" placeholder=" Verify Password *" class="form-control">
                      </div>

                    </div>



                    <div class="col-md-12">
                      <div class="form-group">
                          <button type="button"  data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="{{url('admin/provider')}}">
                            <input type="button" class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
                          </a>
                      </div>
                    </div>
                    </div>
                </form>
            </div>

          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@section('requirejs')
<script type="text/javascript">
$("document").ready(function() {

  setTimeout(function() {
      $("#user").trigger('click');
  },10);
});
$(function () {
  $('.select2').select2()
});

$(document).on('change','#country',function(){

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
$(document).on('change','#state',function(){
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

$(document).on('change','#permanent_country',function(){

    $("#permanent_state").html('<option value="">Select State</option>');
        $("#permanent_state").attr('disabled',true);
        $("#permanent_city").html('<option value="">Select City</option>');
        $("#permanent_city").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/states/list/?country_id='+mainid, function(response){
            $("#permanent_state").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#permanent_state").append('<option value="'+data.id+'">'+data.state_name+'</option>');
                    //console.log('index', data)
                })
            })
        });
});
$(document).on('change','#permanent_state',function(){
    $("#permanent_city").html('<option value="">Select City</option>');
        $("#permanent_city").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/cities/list/?state_id='+mainid, function(response){
            $("#permanent_city").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#permanent_city").append('<option value="'+data.id+'">'+data.city_name+'</option>');
                    //console.log('index', data)
                })
            })
        });
});

$(document).on('change','#long_distance_travel_permit',function(){
    if(this.checked) {
      $("#long_d_t_charge").show();
    }else{
      $("#long_distance_travel").val("");
      $("#long_d_t_charge").hide();

    }
});

</script>
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