@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/signup.css')}}">
@endsection

<section class="page-title" style="background-image:url(assets/images/main-slider/eight-1.jpg);">
  <div class="auto-container">
    <h1 class="text-sky">Forget Password</h1>
  </div>
</section>
<section class="intro-section">
  <div class="container">

  <!--our-quality-shadow-->
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="offset-col-md-3 col-md-5">
        <div class="intro-text text-center">
        <h2>FORGOT PASSWORD</h2>
        <div class="anim-icon"><span class="icon icon-star"></span></div>
        </div>
        <div class="contact-formlogin">
          <form role="forgot" method="post" action="{{url('forgot')}}" id="contact-form" novalidate>
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label>
                     E-mail/Phone
                    </label>
                    <input type="text" name="username" placeholder="E-mail/Phone *" required="">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 form-group">
                      <button type="button" data-request="ajax-submit" data-target="[role='forgot']" class="theme-btn btn-style">Forgot Password</button>
                </div>
                
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
        
    