


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Sub Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List
               <a href="{{route('subadmin.create')}}" class="btn btn-success btn-flat pull-right">
                  Add
                </a>
              </h3>

            </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive">
               <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                  {!! $html->table() !!}
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="ibox-content">
        <div id="editModel" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1>Reset Password</h1>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <form id="editModelForm" role="editpassword"  method="post" action="">
                                    <div class="form-group"><label>New Password</label><input type="text" placeholder="Enter Password" name="password" class="form-control"></div>
                                    <div class="form-group"><label>Confirm Password</label><input type="text" placeholder="Re-Enter Password" name="confirm" class="form-control"></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" data-target='[role="editpassword"]' data-request="ajax-submit" type="button"><strong>Reset</strong></button>
                                    </div>
                                </form>
                    </div>
                     <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
       </div>
</div>
  @push('scripts')
  {!! $html->scripts()!!}
  @endpush

  @section('requirejs')
   <script type="text/javascript">
    
    function loadEdit(id){
       var route = '{{route("subadmin.passwordreset",["subadminid"=>"Sudeep"])}}';
        route = route.replace('Sudeep',id);
        console.log(route);
        $('#editModelForm').attr('action',route);
        $('#editModel').modal('show');

    }
</script>
@endsection

