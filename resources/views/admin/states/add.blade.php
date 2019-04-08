
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add State</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">State</li>
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
                <form  method="post" enctype="multipart/form-data" role="add" action="{{url('admin/states')}}">
                      <div class="form-group">
                         <select class="form-control country" name="country_id" id="country_id" value="">
                            <option value="">Select Country</option>                  
                            @foreach($countries as $country)
                            <option value="{{$country['id']}}">{{$country['country_name']}}</option>                  
                            @endforeach
                         </select>
                        </div>
                  
                      <div class="form-group">
                        <label class="col-sm-2 control-label">State Name</label>
                        <div class="col-sm-10">
                           <input type="text" name="state_name" class="form-control">
                        </div>
                      </div>
                      
                     
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button"  data-request="ajax-submit" data-target='[role="add"]' class="btn btn-success btn-flat">Submit</button>
                          <a href="state.php">
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
 