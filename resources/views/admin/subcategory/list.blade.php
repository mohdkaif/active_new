


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title}}</h1>
          </div>
          <div class="col-sm-6">
           {!!$breadcrumb!!}
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
               <a href="{{url('admin/subcategory/create')}}" class="btn btn-success btn-flat pull-right">
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
  @push('scripts')
  {!! $html->scripts()!!}
   <script type="text/javascript">
         /*function updatestatus(element) {
          alert(element);
         console.log(element);
            $.ajax({
               type:'POST',
               url: "{{url('admin/provider/updatestatus')}}",
               data: {
                  id : test.id,
               } ,
               success:function(data) {
                alert(data.msg);
                  $("#msg").html(data.msg);
               }
            });
         }*/

    $("#submit").click(function () {
    var url = $(location).attr('href');
    $('#spn_url').html('<strong>' + url + '</strong>');
    });

   </script>
   @endpush