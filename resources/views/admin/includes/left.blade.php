<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link bg-success">
      <img src="{{url('assets/images/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3"style="opacity: .8">
      <span class="brand-text font-weight-light">Active Baccha</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        {{--    <img src="images/" style="width:35px; height:35px;" class="img-circle elevation-2" alt="User Image">--}}
        </div>
        <div class="info">
          <a href="editprofile.php" class="d-block"></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->
                         <li class="nav-item">
                          <a href="{{ route('dashboard') }}" class="nav-link  @if (in_array(Request::segment(2),['dashboard'])) active @endif">
                            <i class="fa fa-dashboard nav-icon"></i>
                            <p>Dashboard</p>
                          </a>
                        </li>
                        @if(Auth::user()->user_type=='admin')
                        <li class="nav-item">
                          <a href="{{route('subadmin.index') }}" class="nav-link  @if (in_array(Request::segment(2),['subadmin'])) active @endif">
                          <i class="fa fa-globe nav-icon"></i>
                          <p>Sub Admin</p>
                          </a>
                        </li>
                        @endif
                        
                       <li class="nav-item">
                        <a href="{{ route('states.index') }}" class="nav-link  @if (in_array(Request::segment(2),['states'])) active @endif">
                        <i class="fa fa-globe nav-icon"></i>
                        <p>State</p>
                        </a>
                      </li>
                         <li class="nav-item">
                            <a href="{{url('admin/city')}}" class="nav-link">
                            <i class="fa fa-globe nav-icon"></i>
                            <p>City</p>
                            </a>
                          </li>
                       {{--  
                       <li class="nav-item">
                          <a href="city.php" class="nav-link">
                          <i class="fa fa-globe nav-icon"></i>
                          <p>City</p>
                          </a>
                        </li> --}}

                        <li class="nav-item has-treeview ">
                          <a href="#" class="nav-link @if (in_array(Request::segment(2),['category','subcategory'])) active @endif">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>
                              Category
                              <i class="right fa fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{url('admin/category')}}" class="nav-link @if (in_array(Request::segment(2),['category'])) active @endif">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Service Category</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{url('admin/subcategory')}}" class="nav-link @if (in_array(Request::segment(2),['subcategory'])) active @endif">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Service Sub Category</p>
                                </a>
                              </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                              <a href="{{url('admin/provider')}}" class="nav-link  @if(in_array(Request::segment(2),['provider'])) active @endif">
                                <i class="fa fa-user-secret nav-icon"></i>
                                <p>Service Provider</p>
                              </a>
                        </li>
                         <li class="nav-item has-treeview ">
                          <a href="#" class="nav-link @if (in_array(Request::segment(2),['subscription'])) active @endif">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>
                              Subscription
                              <i class="right fa fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{url('admin/subscription')}}" class="nav-link @if (in_array(Request::segment(2),['subscription'])) active @endif">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Subscription</p>
                                </a>
                              </li>
                          </ul>
                        </li>
               
                      <li class="nav-item">
                        <a href="{{url('admin/user')}}" class="nav-link  @if(in_array(Request::segment(2),['user'])) active @endif">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Users</p>
                        </a>
                      </li>
                
                        <li class="nav-item">
                           <a href="testimonial.php" class="nav-link">
                           <i class="fa fa-star nav-icon"></i>
                           <p>Testimonial</p>
                           </a>
                        </li>
               
                      <li class="nav-item">
                       <a href="enquiry.php" class="nav-link">
                       <i class="fa fa-envelope nav-icon"></i>
                       <p>Enquiry</p>
                       </a>
                    </li>
                 <li class="nav-item has-treeview ">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-sliders"></i>
                    <p>
                      CMS
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
            <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="logo.php" class="nav-link active">
                            <i class="fa fa-globe nav-icon"></i>
                            <p>Logo</p>
                          </a>
                        </li>
                     <li class="nav-item">
                        <a href="slider.php" class="nav-link">
                          <i class="fa fa-sliders nav-icon"></i>
                          <p>Slider</p>
                        </a>
                      </li>
               
                      <li class="nav-item">
                        <a href="about.php" class="nav-link">
                          <i class="fa fa-info-circle nav-icon"></i>
                          <p>About Us</p>
                        </a>
                      </li>
                     <li class="nav-item">
                        <a href="address.php" class="nav-link">
                          <i class="fa fa-address-book nav-icon"></i>
                          <p>Contact Address</p>
                        </a>
                      </li>
                     <li class="nav-item">
                        <a href="help-support.php" class="nav-link">
                          <i class="fa fa-info-circle nav-icon"></i>
                          <p>Help &amp; Support</p>
                        </a>
                      </li>
                
                      <li class="nav-item">
                        <a href="terms_conditions.php" class="nav-link">
                          <i class="fa fa-cogs nav-icon"></i>
                          <p>Terms & Conditions</p>
                        </a>
                      </li>
                
                    <li class="nav-item">
                        <a href="privacy.php" class="nav-link">
                          <i class="fa fa-user-secret nav-icon"></i>
                          <p>Pravacy Policy</p>
                        </a>
                      </li>
              
                     <li class="nav-item">
                        <a href="social-links.php" class="nav-link">
                          <i class="fa fa-link nav-icon"></i>
                          <p>Social Links</p>
                        </a>
                      </li>
            </ul>
          </li>



        </ul>



      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>