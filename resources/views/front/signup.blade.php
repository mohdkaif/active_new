@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/signup.css')}}">
@endsection
<section class="page-title" style="background-image:url(assets/images/main-slider/eight-1.jpg);">
    <div class="auto-container">
        <h1 class="text-sky">Signup</h1>
    </div>
</section>
<section >
    <div class="container">
        <!--our-quality-shadow-->
        <div class="clearfix"></div>
        <div class="row">
            <div class="intro-text text-center">
                <h2>SIGNUP</h2>  
            </div>
            <div class="contact-formlogin">
                <!--Contact Form-->
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="click">
                            <label class="radio"><p>User</p>
                                <input type="radio" name="one" id="user" data-request="address-form" data-target="#address" data-id="user" data-url="{{url('get-user-form')}}" name="one" checked>
                                <span class="checkround"></span>
                            </label>
                            <label class="radio"><p>Service Provider</p>
                                <input type="radio" name="one"  data-request="address-form" data-target="#address" data-id="provider" data-url="{{url('get-user-form')}}" >
                                <span class="checkround"></span>
                            </label>
                        </div>
                    </div>
                    <!--- user form Design ------------------>
                    <div id="address" class="showhide">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
        
@section('requirejs')
<script src="{{url('assets/js/price_range_script.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap 4 -->
<script src="{{url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/admin/plugins/select2/select2.full.min.js')}}"></script>

<script src="{{url('assets/admin/plugins/select2/select2.full.min.js')}}"></script>


<script type="text/javascript">
$("document").ready(function() {
  setTimeout(function() {
      $("#user").trigger('click');
  },10);
});
$(function () {
  $('.select2').select2()
});

function get_city(str) {
   var dataString = 'state_id='+str;
   
   $.ajax({
     type:'POST',
     data:dataString,
     url:base_url + '/cities/list',
     success:function(data) {
       console.log(data.html);
       $("#city").html(data.html);
    
     }
   });
}

function get_city1(str) {
   var dataString = 'state_id='+str;
   
   $.ajax({
     type:'POST',
     data:dataString,
     url:base_url + '/cities/list',
     success:function(data) {
       console.log(data.html);
       $("#city1").html(data.html);
    
     }
   });
}

   
</script>
@endsection