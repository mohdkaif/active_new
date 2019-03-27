  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Bank Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> Bank Details</li>
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
               Edit 
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
                <form  role="bank" method="post" action="{{url('admin/provider/edit-bank/'.base64_encode($bank['id']))}}" enctype="multipart/form-data">
                  <input type="hidden" name="user_id" value="{{base64_encode($bank['id'])}}">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-8 control-label">Bank Account Holder Name</label>
                          <div class="col-sm-12">
                             <input type="text" name="bank_holder_name" value="{{$bank['bank_holder_name']}}" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-8 control-label">Bank Name</label>
                            <div class="col-sm-12">
                               <input type="text" name="bank_name" value="{{$bank['bank_name']}}" class="form-control" required>
                            </div>
                          </div>
                      </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-8 control-label">Bank Account Number</label>
                            <div class="col-sm-12">
                               <input type="text" name="bank_account_number" value="{{$bank['bank_account_number']}}" class="form-control" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label class="col-sm-8 control-label">IFC Code</label>
                              <div class="col-sm-12">
                                 <input type="text" name="bank_ifsc_code" value="{{$bank['bank_ifsc_code']}}" class="form-control" required>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-8 control-label">Branch Name</label>
                            <div class="col-sm-12">
                               <input type="text" name="bank_branch_name" value="{{$bank['bank_branch_name']}}" class="form-control" required>
                            </div>
                          </div>
                        </div>
                    </div>     
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" data-target='[role="bank"]' data-request="ajax-submit" name="submit" class="btn btn-success btn-flat">Submit</button>
                          <a href="{{url('admin/provider')}}">
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