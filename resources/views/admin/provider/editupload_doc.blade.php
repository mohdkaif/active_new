
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Documents</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Documents</li>
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
                <form  role="qualification" action="{{url('admin/provider/edit-document/'.base64_encode($qualification['id']))}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="user_id" value="{{base64_encode($qualification['id'])}}">
                     <div class="form-group">
                        <label class="col-sm-6 control-label">Highschool Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_high_school"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Intermediate Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_intermediate" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Graduation Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_graduation"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Post Graduation Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_post_graduation"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Adhar Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_adhar_card"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Other Document</label>
                        <div class="col-sm-6">
                          <input type="file" name="document_other" class="form-control">
                        </div>
                    </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" data-request="ajax-submit"  data-target='[role="qualification"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="{{url('admin/provider')}}">
                            <input type="button"  class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
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
   