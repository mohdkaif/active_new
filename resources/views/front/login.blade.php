@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/signup.css')}}">
@endsection
             
<section class="page-title" style="background-image:url(assets/images/main-slider/eight-1.jpg);">

  <div class="auto-container">
     
     <h1 class="text-sky">Login</h1>
     
  </div>
</section>
   
<section class="intro-section">
  <div class="container">
  <!--our-quality-shadow-->
    <div class="clearfix"></div>
      <div class="row">
        <div class="tab" role="tabpanel">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
             <li role="presentation" class="active"><a href="javascript:void(0)" aria-controls="home" id="user" role="tab" data-toggle="tab"></i>User Login</a></li>
             <li role="presentation"><a href="javascript:void(0)" aria-controls="settings" role="tab" id="provider" data-toggle="tab">Service Provider</a></li>
             {{-- <li role="presentation"><a href="javascript:void(0)" aria-controls="profile" role="tab" id="guest" data-toggle="tab">Guest Login</a></li> --}}
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
             <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                <div class="contact-formlogin">
                <!--Contact Form-->
                  <form role="login" method="post" action="{{url('login')}}" id="contact-form" novalidate>
                      <input type="hidden" name="user_type" id="user_type" value="">
                      <div class="row clearfix">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label>
                               E-mail/Phone
                              </label>
                              <input type="text" name="username" placeholder="E-mail/Phone *" required>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label>
                                Password
                              </label>
                              <input type="password" name="password" placeholder="Password *" required>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                              <button type="button" data-request="ajax-submit" data-target="[role='login']" class="theme-btn btn-style">Login</button>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">
                            <a href="{{url('forgot-password')}}" class="pull-right">Forgot Password ?</a>
                          </div>
                      </div>
                  </form>
              </div>
             </div>
             
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@section('requirejs')
<script type="text/javascript">
$(document).ready(function(){ // on document ready
    $("#user").click(); // click the element
})
  $('#user').click(function(){
      $('#user_type').val('user');
  });
  
  $('#provider').click(function(){
      $('#user_type').val('provider');
  });
  $('#guest').click(function(){
    $('#user_type').val('guest');
  });
</script>
@endsection
