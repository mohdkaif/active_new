  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit  Sub Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> Sub Admin</li>
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
                <form  method="POST" enctype="multipart/form-data" role="add" action="{{route('subadmin.update',___encrypt($details['id']))}}">
                  <input type="hidden" name="_method" value="PUT">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image</label><br/>
                         <input type="file" name="image" onchange="imagePreview(this, '#image1');">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>
                            <img id="image1" src="{{___defaultimage($details['image'],'assets/images/users/')}}" height="200px;" width="250px;">
                           
                      </div>
                    </div>
                  </div>
                  <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">First Name </label>
                        <div class="col-sm-12">
                           <input type="text" name="first_name" value="{{$details['first_name']}}" class="form-control">
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Last Name</label>
                        <div class="col-sm-12">
                           <input type="text" name="last_name" value="{{$details['last_name']}}"  class="form-control">
                        </div>
                      </div>
                  </div>
                  <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Phone Number</label>
                        <div class="col-sm-12">
                           <input type="text" name="phone_number" value="{{$details['mobile']}}" class="form-control">
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-12">
                           <input type="text" name="email" value="{{$details['email']}}"  class="form-control">
                        </div>
                      </div>
                  </div>
                   <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Date Of Birth</label>
                        <div class="col-sm-12">
                           <input type="date" name="date_of_birth" value="{{$details['date_of_birth']}}" class="form-control">
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Gender</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="gender">
                             <option value="">Select Gender</option>
                             <option value="male"@if($details['gender']=='male') selected @endif>Male</option>
                             <option value="female" @if($details['gender']=='female') selected @endif>Female</option>
                           </select>
                        </div>
                      </div>
                  </div>
                 <div class="col-md-12">
                      <div class="form-group">
                        <h5><b>Present Address</b></h5>
                      </div>
                    <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Region</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="country" id="country" style="height: 45px;" >
                            <option value="">Select Region</option>
                              @if(!empty($country))
                                 @foreach($country as $countries)
                                    <option  value="{{$countries->id}}" @if($details['country']==$countries->id) selected @endif >{{$countries->country_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="pwd">State:</label>
                        <div class="input-group">
                          <select class="form-control" name="state" id="state" style="height: 45px;" >
                            <option value="{{$details['state_details']['id']}}">{{$details['state_details']['state_name']}}</option>
                          </select>
                        </div>
                       </div>
                    </div>
                    <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="city" id="city" style="height: 45px;" >
                            <option value="{{$details['city_details']['id']}}">{{$details['city_details']['city_name']}}</option>
                          </select>
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="pwd">Address:</label>
                        <div class="input-group">
                         <textarea class="form-control" name="address" id="address"  autocomplete="off" placeholder="&nbsp;&nbsp;Present Full address" style="resize: none;" rows="4" cols="70">{{$details['address']}}</textarea>
                        </div>
                       </div>
                    </div>
                      <div class="form-group">
                        <h5><b>Permanent Address</b><input type="checkbox" onclick="fillAddress(this.id);" id="same">Same as Present Address</h5>
                      </div>
                    <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Region</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="permanent_country" id="permanent_country" style="height: 45px;" >
                            <option value="">Select Region</option>
                              @if(!empty($country))
                                 @foreach($country as $countries)
                                    <option  value="{{$countries->id}}" @if($details['permanent_country']==$countries->id) selected @endif >{{$countries->country_name}}</option>
                                 @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="pwd">State:</label>
                        <div class="input-group">
                          <select class="form-control" name="permanent_state" id="permanent_state" style="height: 45px;" >
                            <option value="{{$details['permanent_state_details']['id']}}">{{$details['permanent_state_details']['state_name']}}</option>
                          </select>
                        </div>
                       </div>
                    </div>
                    <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Permanent City</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="permanent_city" id="permanent_city" style="height: 45px;" >
                            <option value="{{$details['permanent_city_details']['id']}}">{{$details['permanent_city_details']['city_name']}}</option>
                          </select>
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="pwd">Address:</label>
                        <div class="input-group">
                         <textarea class="form-control" name="permanent_address" id="permanent_address"  autocomplete="off" placeholder="&nbsp;&nbsp;Permanent Full address" style="resize: none;" rows="4" cols="70">{{$details['permanent_address']}}</textarea>
                        </div>
                       </div>
                    </div>
                      <div class="col-md-12">
                      <div class="form-group">
                          <button type="button"  data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="{{route('subadmin.index')}}">
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
<script type="text/javascript">
   $(document).ready(function(){
       $('input[type="checkbox"]').click(function(){
           if($(this).prop("checked") == true){
                $("#permanent_country").val($("#country").val()); 
                $("#permanent_state").html($("#state").html());  
                $("#permanent_state").val($("#state").val());
                $("#permanent_city").html($("#city").html());    
                $("#permanent_city").val($("#city").val());  
                $("#permanent_address").val($("#address").val());           
           }
           else if($(this).prop("checked") == false){
                $("#permanent_country").val(''); 
                $("#permanent_state").val('');  
                $("#permanent_city").val('');  
                $("#permanent_address").val('');    
           }
       });
   });
</script>

@endsection