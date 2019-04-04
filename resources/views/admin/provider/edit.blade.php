  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit  Service Providers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Service Providers</li>
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
               Edit Details
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
                <form  method="POST" enctype="multipart/form-data" role="add" action="{{url('admin/provider/'.base64_encode($user['id']))}}">
                  <input type="hidden" name="_method" value="PUT">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image</label><br/>
                         <input type="file" name="image" onchange="imagePreview(this, '#image1');">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>
                            @if(!empty($user['image']))
                              <img id="image1" height="200px;" width="250px;" src="{{url('assets/images/users/'.$user['image'])}}">
                            @else
                              <img id="image1" height="200px;" width="250px;">
                            @endif
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>First Name</label>
                           <input type="text" id="first_name" autocomplete="off" name="first_name" placeholder="First Name *"  class="form-control" value="{{!empty($user['first_name'])?$user['first_name']:''}}">
                      </div>
                      <input type="hidden" name="type" value="provider">
                      <div class="form-group">
                        <label>Phone number</label>
                           <input type="text" name="mobile" id="service_provider_phone" autocomplete="off" placeholder=" Phone number *" class="form-control" readonly value="{{!empty($user['mobile'])?$user['mobile']:''}}">
                      </div>
                       <div class="form-group">
                        <label>Date of birth</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                               <input type="text" class="form-control" name="date_of_birth" autocomplete="off" id="start_datepicker" placeholder="DD-MM-YY"  value="{{!empty($user['date_of_birth'])?$user['date_of_birth']:''}}">
                         </div>
                      </div>
                      
                     
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                           <input type="text" id="last_name"  autocomplete="off" name="last_name" placeholder="Last Name *" class="form-control" value="{{!empty($user['last_name'])?$user['last_name']:''}}">
                      </div>
                     

                      {{--  <div class="form-group">
                          <label>Specialization</label>
                          <select class="form-control select2" name="specialization[]" multiple="multiple" data-placeholder="Select Specialization" style="width: 100%;" >
                                <option value="">Optin</option>
                          </select>
                        </div> --}}

                      <div class="form-group">
                        <label>Email</label>
                           <input type="email"  id="service_provider_email" name="email" autocomplete="off" placeholder=" Email *"  class="form-control" value="{{!empty($user['email'])?$user['email']:''}}">
                      </div>
                       
                     

                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Distance Travel</label>
                           <input type="text" id="last_name"  autocomplete="off" name="distance_travel" placeholder="Distance Travel " class="form-control" value="{{!empty($user['provider_user']['distance_to_travel'])?$user['provider_user']['distance_to_travel']:''}}">
                      </div>
                     
                      <div class="checkbox col-md-6">
                        <label></label><input type="checkbox" value="yes" name="location_track_permission" @if(!empty($user['provider_user']['location_track_permission']) && $user['provider_user']['location_track_permission']=='yes') checked @endif>Location Track Permission
                      </div>
                      
                     

                    </div>
                    <div class="col-md-6">
                      
                      <div class="checkbox col-md-6">
                     
                        <label></label><input type="checkbox" value="yes" id="long_distance_travel_permit" name="long_distance_travel_permit" @if(!empty($user['provider_user']['long_distance_travel'])) checked @endif>Long Distance Travel:
                    
                        
                      </div>
                        @if(!empty($user['provider_user']['long_distance_travel'])) 
                          <div class="form-group" id="long_d_t_charge" style="display:block">
                            <label for="pwd">Long Distance Travel Charges:</label>
                          
                            <input type="text" id="long_distance_travel" name="long_distance_travel" placeholder="Long Distance Travel Charges" class="form-control"  value="{{!empty($user['provider_user']['long_distance_travel'])?$user['provider_user']['long_distance_travel']:''}}">
                            
                          </div>
                        @else
                          <div class="form-group" id="long_d_t_charge" style="display:none">
                            <label for="pwd">Long Distance Travel Charges:</label>
                          
                            <input type="text" name="long_distance_travel" placeholder="Long Distance Travel Charges" class="form-control">
                            
                          </div>
                       @endif
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
                                    <option @if(!empty($user['country']) && $user['country']==$countries->id) selected @endif value="{{$countries->id}}">{{$countries->country_name}}</option>
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
                             @if(!empty($selected_states))
                                 @foreach($selected_states as $selected_state)
                                    <option @if(!empty($user['state']) && $user['state']==$selected_state->id) selected @endif value="{{$selected_state->id}}">{{$selected_state->state_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <div class="input-group">
                          <select class="" name="city" id="city" style="height: 45px;" >
                            <option value="">Select City</option>
                              @if(!empty($selected_cities))
                                @foreach($selected_cities as $selected_city)
                                  <option @if(!empty($user['city']) && $user['city']==$selected_city->id) selected @endif value="{{$selected_city->id}}">{{$selected_city->city_name}}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label>Present Address</label> <!-- <lable class="pull-right"><input type="checkbox"  name="same_address">&nbsp;<b>Same Permanent Address</b></lable> -->
                           <textarea name="address" id="address"  autocomplete="off" placeholder="&nbsp;&nbsp;Present Full address" style="resize: none;" rows="4" cols="70">{{!empty($user['address'])?$user['address']:''}}</textarea>
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
                                    <option @if(!empty($user['permanent_country']) && $user['permanent_country']==$countries->id) selected @endif value="{{$countries->id}}">{{$countries->country_name}}</option>
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
                             @if(!empty($permanent_selected_states))
                                 @foreach($permanent_selected_states as $permanent_selected_state)
                                    <option @if(!empty($user['permanent_state']) && $user['permanent_state']==$permanent_selected_state->id) selected @endif value="{{$permanent_selected_state->id}}">{{$permanent_selected_state->state_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                         <div class="input-group">
 
                          <select class="" name="permanent_city" id="permanent_city" style="height: 45px;" >
                            <option value="">Select City</option>
                              @if(!empty($permanent_selected_cities))
                                 @foreach($permanent_selected_cities as $permanent_selected_city)
                                    <option @if(!empty($user['permanent_city']) && $user['permanent_city']==$permanent_selected_city->id) selected @endif value="{{$permanent_selected_city->id}}">{{$permanent_selected_city->city_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>Permanent Address</label>
                        
                           <textarea  name="permanent_address" id="permanent_address"  placeholder="&nbsp;&nbsp;Permanent Full address" style="resize:none;"  rows="4" cols="70">
                             {{!empty($user['permanent_address'])?$user['permanent_address']:''}}
                           </textarea>
                      
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