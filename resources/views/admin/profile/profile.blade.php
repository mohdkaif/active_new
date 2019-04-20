  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(isset($msg)){echo $msg;}?>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
               Enter Details
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
                <form  role="add" method="post" action="{{route('profile.updateprofile')}}" enctype="multipart/form-data">
                           <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-12">
                           <input type="text" name="password" class="form-control">
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-12">
                           <input type="text" name="confirm"  class="form-control">
                        </div>
                      </div>
                  </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Update Profile Picture</label>
                        <div class="col-sm-10">
                         <input type="file" name="profile" onChange="readURL(this,1);">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>
                              <img id="image1" height="200px;" width="250px;" src="{{___defaultimage(Auth::user()->image,'assets/images/users/')}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="index.php">
                            <input type="button" class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
                          </a>
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
       
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }   
        }
    </script>
  @endsection