<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>City</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">City</li>
            </ol>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         <div class="col-md-4">
                 <div class="form-group">
                 <select class="form-control country" name="country_id" id="country_id" value="">
                    <option value="">Select Country</option>                  
                    @foreach($countries as $country)
                    <option value="{{$country['id']}}">{{$country['country_name']}}</option>                  
                    @endforeach
                 </select>
                </div>
                <div class="form-group">
                 <select class="form-control state" name="state_id" id="state_id" value="">
                    <option value="">Select State</option>                  
                    @foreach($states as $state)
                    <option value="{{$state['id']}}">{{$state['state_name']}}</option>                  
                    @endforeach
                 </select>
                </div>
              </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Details 
                <a href="{{url('admin/city/create')}}" class="btn btn-success btn-flat pull-right">
                  Add City
                </a>
               </h3>
            </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>City Name</th>
                  <th>State Name</th>
                    <th>Status</th>
                 {{--  <th>Country Name</th>
                  <th>Status</th>
                  <th class="action" >Action</th> --}}
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
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

  @push('scripts')

<script type="text/javascript">
    
    $(document).ready(function(){
      function myfunction(id,status){
         var message = '';
        if(status == 'active') {
          message = "Are you sure to inactivate this state?";
        } else if (status == 'inactive') {
          message = "Are you sure to activate this state?";
        } else {
          message = "Are you sure to delete this state?";
        }  

           var result =  confirm(message);
        
          if (result && status == 'active' || status == 'inactive') {
              $('#subscription_id').val("{{old('subscription_id')}}");
             document.getElementById('changeStatusForm_'+ id).submit();
          } else if(result){
            document.getElementById('deleteform_'+ id).submit();
          }      

      }
    })

  </script>
  <script>

    $(document).ready(function(){
        $(function () {

          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      $(document).ready(function(){
       /* if ($("#country_id").val() === "") {
          alert('Please select country.');
          return false;
        }*/
        $("#country_id").change(function () {
        $("#state_id").html('<option value="">Select State</option>');
        $("#state_id").attr('disabled',true);
       
        var mainid = $(this).val();
        $.get('{{url('/')}}/get-states/'+mainid, function(response){
            $("#state_id").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#state_id").append('<option value="'+data.id+'">'+data.state_name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });
         $("select.state").change(function(){
                var country_id = $("#country_id option:selected").val();
                var state_id = $("#state_id option:selected").val();

                if(country_id && state_id)
                {
                  var t = $('#example1').DataTable({
                     processing: true,
                     serverSide: true,
                     lengthChange: true,
                     order: [ 0, 'asc' ],
                     searchable:true,
                     bStateSave: false,
                     bDestroy: true,
                     oSearch: {
                          "bSmart": false, 
                          "bRegex": true,
                          "sSearch": ""                
                      },
                     
                      "ajax": {
                          url: "{{route('city.table')}}",
                          data: function (d) {
                             d.c_id = country_id,
                             d.s_id = state_id
                          },
                      },
                      "columns": [
                       { data: 'city_name', name: 'city_name', searchable: true, orderable: true },
                        { data: 'state_name', name: 'state_name', searchable: true, orderable: true },
                      
                        { data: 'status', name: 'status', searchable: true, orderable: true },
                       /* { data: 'action', name: 'action', sortable: false, searchable: false,},*/
                      ]
                 });
                }
                else
                {
                  alert('Please select country & state.');
                  return false;
                }
            });
        });
    });
</script>

@endpush