
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Qualifications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Qualifications</li>
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
                <form  method="post" enctype="multipart/form-data">

                      
                     <div class="form-group">
                        <label class="col-sm-6 control-label">Highschool Year</label>
                        <div class="col-sm-6">
                          <input type="text" name="highschool_year" value="{{$qualification['highschool_year']}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Intermediate Year</label>
                        <div class="col-sm-6">
                          <input type="text" name="intermediate_year" value="{{$qualification['intermediate_year']}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Graducation Year</label>
                        <div class="col-sm-6">
                          <input type="text" name="graducation_year" value="{{$qualification['graducation_year']}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Post Graducation Year</label>
                        <div class="col-sm-6">
                          <input type="text" name="post_graducation_year" value="{{$qualification['post_graducation_year']}}" class="form-control">
                        </div>
                    </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success btn-flat">Submit</button>
                          <a href="qualification.php">
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
   