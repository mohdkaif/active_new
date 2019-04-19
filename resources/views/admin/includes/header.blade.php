{{-- <script>

window.setInterval(function(){  

$("#time").load("hh.php");

}, 1000);

</script> --}}

<style>

#time{padding-left: 30%; top:5px; font-size:20px; color:#fff;font-weight:500;}

</style>

<nav class="main-header navbar navbar-expand border-bottom navbar-light bg-success">

    <!-- Left navbar links -->

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>

      </li>

     

    </ul>



<div align="center" id="time"></div>



    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">

     <li class="dropdown user user-menu">

         <a href="#" class=""  data-toggle="dropdown">

                  <img src="{{___defaultimage(Auth::user()->image,'assets/images/users/')}}" class="user-image" alt="User Image">

                  <span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>

          </a>

           <ul class="dropdown-menu">

             <!-- User image -->

              <li class="user-header">

               <img src="{{___defaultimage(Auth::user()->image,'assets/images/users/')}}" class="img-circle" alt="User Image">

                <p>

                 {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                 <br>
                 {{strtoupper(Auth::user()->user_type)}}

                </p>

              </li>

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="pull-left">

                 <a href="{{route('profile.edit')}}" class="btn btn-default btn-flat">Profile</a>

               </div>

                <div class="pull-right">

                  <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Sign out</a>

               </div>

              </li>

            </ul>

      </li>
    </ul>

  </nav>