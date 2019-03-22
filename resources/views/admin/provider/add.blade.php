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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                <form  method="post" enctype="multipart/form-data" role="add" action="{{url('admin/provider')}}">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image</label><br/>
                         <input type="file" name="service_providers_image" onchange="imagePreview(this, '#image1');">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>
                           <img id="image1" height="200px;" width="250px;">
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>First Name</label>
                           <input type="text" id="service_provider_fname" autocomplete="off" name="service_provider_fname" placeholder="First Name *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Phone number</label>
                           <input type="text" name="service_provider_phone" id="service_provider_phone" autocomplete="off" placeholder=" Phone number *" class="form-control">
                      </div>
                       <div class="form-group">
                        <label>Date of birth</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                              </div>
                                 <input type="text" class="form-control" name="service_provider_dob" autocomplete="off" id="start_datepicker" placeholder="DD-MM-YY" required>
                           </div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                           <input type="password" name="service_provider_password"  id="passworduser"  autocomplete="off" placeholder=" Password *" required class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                           <input type="text" id="service_provider_lname"  autocomplete="off" name="service_provider_lname" placeholder="Last Name *" class="form-control">
                      </div>
                     

                       <div class="form-group">
                          <label>Specialization</label>
                          <select class="form-control select2" name="specialization[]" multiple="multiple" data-placeholder="Select Specialization" style="width: 100%;" required>
                                <option value="">Optin</option>
                          </select>
                        </div>

                      <div class="form-group">
                        <label>Email</label>
                           <input type="email" onBlur="emailvalidate(this.value)" id="service_provider_email" name="service_provider_email" autocomplete="off" placeholder=" Email *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Re-Password</label>
                           <input type="password" name="re-password" autocomplete="off" onBlur="conformval();" id="cpasswordUser" placeholder=" Re-Password *" required class="form-control">
                      </div>

                    </div>

                    <div class="col-md-12">
                       <div class="form-group">
                        <label>Gender</label><br/>
                          <label>
                            <input type="radio" name="service_provider_gender" value="Male" checked>
                                Male
                          </label>
                          <label>
                            <input type="radio" name="service_provider_gender" value="Female">
                              Female
                          </label>
                          <label>
                            <input type="radio" name="service_provider_gender" value="Other">
                            Other
                          </label>
                      </div>
                    </div>

                  
                    <div class="col-md-6">
                      <div class="form-group">
                            <h5><b>Present Address</b></h5>
                      </div>
                      <div class="form-group">
                        <label>State</label>
                           <select class="form-control" name="present_state" onChange="get_city(this.value);" required>
                              <option value="">select State Name</option>
                              <option value="">state Name</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                          <select class="form-control" name="present_city" id="city"  required>
                           <option value="">select City Name</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                           <input type="text" name="present_region" autocomplete="off" placeholder=" Region *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Pin Code</label>
                           <input type="text" name="present_pin_code" autocomplete="off" placeholder="Pin Code *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Present Address</label> <!-- <lable class="pull-right"><input type="checkbox"  name="same_address">&nbsp;<b>Same Permanent Address</b></lable> -->
                           <textarea name="present_address" id="present_address" onkeyup="get_address(this.value)" autocomplete="off" placeholder="&nbsp;&nbsp;Present Full address" style="resize: none;" rows="4" cols="70"></textarea>
                      </div>

                    </div>

                    

                    <div class="col-md-6">
                      <div class="form-group">
                            <h5><b>Permanent  Address</b></h5>
                      </div>
                      <div class="form-group">
                        <label>State</label>
                           <select class="form-control" name="permanent_state" onChange="get_city1(this.value);" class="form-group" required>
                              <option value="">salect State Name</option>
                        
                              <option value="">State NAme</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                          <select  class="form-control" name="permanent_city" id="city1" required>
                              <option value="">select City Name</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                           <input type="text" autocomplete="off" name="permanent_region" placeholder=" Region *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Pin Code</label>
                           <input type="text" autocomplete="off" name="permanent_pin_code" placeholder="Pin Code *" required class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>Permanent Address</label>
                        
                           <textarea  name="permanent_address" id="permanent_address"  placeholder="&nbsp;&nbsp;Permanent Full address" style="resize:none;" required rows="4" cols="70"></textarea>
                      
                      </div>

                    </div>



                    <div class="col-md-12">
                      <div class="form-group">
                          <button type="submit" name="submit" data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="service_providers.php">
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
