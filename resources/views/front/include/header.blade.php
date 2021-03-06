<header class="main-header">
   <!-- Main Box -->
   <div class="header-lower">
      <div class="auto-container">
         <div class="logo"><a href="{{url('/')}}"><img src="{{url('assets/images/logo.png')}}"></a></div>
         <div class="burger"> <span></span> </div>
         <nav>
            <ul class="main">
               <li class="current"><a href="{{url('/')}}">Home</a></li>
               <li><a href="{{url('/event')}}">Activity</a></li>
               <li><a href="{{url('/event')}}">Events & Workshops</a></li>
               <li><a href="{{url('/event')}}">Packages</a></li>
               <li><a href="{{url('/event')}}">Kids Boutique</a></li>
               <li><a href="{{url('/about')}}">About Us  </a></li>
               <li><a href="#">Help</a></li>
               <li><a href="#">Privacy Policy</a></li>
               <li><a href="#">Terms & Conditions</a></li>
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
            

               @if(\Auth::user()->user_type=='user')
               <div class="header-bottom">
                  <a href="{{url('user/profile')}}" class="btn btn-default btn-default1 center-block pull-left">Profile</a>
                 {{--  <a href="{{url('user/dashboard')}}" class="btn btn-default btn-default1 center-block pull-left">Dashboard</a> --}}
               </div>
               @else
               <div class="header-bottom">
                  <a href="{{url('provider/profile')}}" class="btn btn-default btn-default1 center-block pull-left">Profile</a>
               </div>
               <div class="header-bottom">
                  <a href="{{url('provider/dashboard')}}" class="btn btn-default btn-default1 center-block pull-left">Dashboard</a>
               </div>
               @endif
               <div class="header-bottom">
                  <a href="{{url('logout')}}" class="btn btn-default btn-default1 center-block pull-left">Logout</a>
               </div>
        @endif
         </nav>
         <div class="overlay"></div>
      </div>
   </div>
</header>