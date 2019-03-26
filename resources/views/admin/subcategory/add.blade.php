  <div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Service Sub Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Service Sub Category</li>
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
               Add 
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
                <form  method="post" role="add" action="{{url('admin/subcategory')}}">
                  <div class="row" class="col-sm-12">
                      <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Select Category </label>
                        <div class="col-sm-12">
                           <select class="form-control" name="service_category_name">
                             <option  value="">Select Category</option>
                             @foreach($category as $value)
                              <option value="{{$value['service_category_id']}}">{{$value['service_category_name']}}</option>
                             @endforeach
                           </select>
                        </div>
                      </div>
                       <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">Sub Category Name</label>
                        <div class="col-sm-12">
                           <input type="text" name="service_sub_category_name"  class="form-control">
                        </div>
                      </div>
                    </div>

                     

                     
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button"  data-request="ajax-submit" data-target='[role="add"]'  class="btn btn-success btn-flat">Submit</button>
                          <a href="{{url('admin/subcategory')}}">
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