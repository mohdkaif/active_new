  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Provider Location</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> >Provider Location</li>
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
               Choose Provider
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
                {{-- <form  method="POST" role="update" action="{{url('admin/view-provider-location')}}"> --}}
                    
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-8 control-label">Provider</label>
                            <div class="col-sm-12">
                               <select  name="provider" id="provider" class="form-control">
                                <option value="">Select Provider</option>
                                @if(!empty($providers))
                                  @foreach($providers as $k => $v)
                                    <option value="{{$v['id']}}">{{$v['first_name']}} {{$v['last_name']}}</option>
                                  @endforeach
                                @endif
                               </select>
                            </div>
                          </div>
                        </div>
                    </div>     
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                         {{--  <button type="button"  data-request="ajax-submit" data-target='[role="update"]'  class="btn btn-success btn-flat">Submit</button> --}}
                          <a href="bank_details.php">
                            <input type="button" class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
                          </a>
                        </div>
                    </div>
               {{--  </form> --}}

                <div id="googleMap" style="width:100%;height:400px;"></div>
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
  <script>

    $('#provider').on('change', function() {
      var val = this.value ;
      $.ajax({
                type: "GET",
                url: "{{url('admin/provider-location')}}",
                data: {value: val},

                success: function(data){
                  /*  alert(data.latitude);*/
                    myMap(data.latitude,data.longitude)
                    /*if ($('.count:last').val()>9){
                        
                        $("#load-more").fadeIn();
                    }*/
                    

                 }
            });
    });
  </script>
  <script>
  
  function myMap(latitude,longitude) {
  var mapProp= {
    center:new google.maps.LatLng(latitude,longitude),
    zoom:5,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvdluAr7Q_zvrHcxslyRsrndr11LxHpOw&callback=myMap"></script>
  @endsection