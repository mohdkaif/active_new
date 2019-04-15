  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Subscription</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> Subscription</li>
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
                <form  method="POST" enctype="multipart/form-data" role="add" action="{{url('admin/subscription')}}">
                
                  <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Name </label>
                        <div class="col-sm-12">
                           <input type="text" name="name" placeholder="Name Of Subscription" class="form-control">
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description"  autocomplete="off" placeholder="&nbsp;&nbsp;Description Of Subscription" style="resize: none;" rows="4" cols="70"></textarea>
                        </div>
                      </div>
                  </div>
                  <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Months</label>
                        <div class="col-sm-12">
                           <input type="text" name="months"  placeholder="Number Of Months" class="form-control">
                        </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Price</label>
                        <div class="col-sm-12">
                           <input type="text" name="price" placeholder="Price Of Subscription" class="form-control">
                        </div>
                      </div>
                    </div>
                      <div class="col-md-12">
                      <div class="form-group">
                          <button type="button"  data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="{{url('admin/subscription')}}">
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
@section('requirejs')
<script type="text/javascript">

</script>


@endsection