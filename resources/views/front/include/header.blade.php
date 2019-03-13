<header class="main-header">
   <!-- Main Box -->
   <div class="header-lower">
      <div class="auto-container">
         <div class="logo"><a href="{{url('/')}}"><img src="{{url('assets/images/logo.png')}}"></a></div>
         <div class="burger"> <span></span> </div>
         <nav>
            <ul class="main">
               <li class="current"><a href="{{url('/')}}">Home</a></li>
               <li><a href="{{url('/event')}}">Events </a></li>
               <li><a href="{{url('/about')}}">About Us  </a></li>
               <li><a href="#">Help</a></li>
               <li><a href="#">Privacy Policy</a></li>
               <li><a href="#">Tearm & Conditions</a></li>
               <li><a href="{{url('/contact')}}">Contact Us</a></li>
            </ul>
         <!-- before logib -->
         @if(empty(\Auth::user()))
            <div class="header-bottom">
               <a href="{{url('/signup')}}" class="btn btn-default btn-default1 center-block pull-left">Signup</a>
            </div>
            <br>
            <div class="header-inr">
               <a href="{{url('/login')}}" class="btn btn-default btn-default2 center-block pull-left">Login</a>
            </div>
         @else
          <!-- After login -->
            <div class="header-bottom">
               <a href="service_provider_dashboard.php" class="btn btn-default btn-default1 center-block pull-left">Profile</a>
            </div>
        @endif
         </nav>
         <div class="overlay"></div>
      </div>
   </div>
</header>