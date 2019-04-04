
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Request</li>
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
               View Details
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
                          <p class="help-block"><strong>Image:</strong></p>
                            @if(!empty($user['image']))
			                    <td><img style="height:60px;" src="{{url('assets/images/users/'.$user['image'])}}"></td>
			                @else
			                    <td><img style="height:60px;" src="{{url('assets/images/user.png')}}"></td>
			                
			                @endif
                          
                      </div>
                      <div class="form-group">
                      <p class="help-block"><strong>Date:</strong> {{date('Y-m-d',strtotime($user['created_at']))}}</p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Full Name :</strong> {{!empty($user['first_name'])?$user['first_name']:''}}&nbsp; {{!empty($user['last_name'])?$user['last_name']:''}}</p>
                      </div>
                      

                       <div class="form-group">
                        <p class="help-block"><strong>Mobile :</strong>  {{!empty($user['mobile'])?$user['mobile']:''}}</p>
                      </div>
                      
                      <div class="form-group">
                        <p class="help-block"><strong>Email :</strong> {{!empty($user['email'])?$user['email']:''}}</p>
                      </div>

                      <div class="form-group">
                        <p class="help-block"><strong>Address :</strong> {{!empty($user['address'])?$user['address']:''}}</p>
                      </div>

                      
                      <div class="form-group">
                        <p class="help-block"><strong>Region :</strong> {{!empty($user['country_details']['name'])?$user['country_details']['name']:''}}</p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>State :</strong>{{!empty($user['state_details']['name'])?$user['state_details']['name']:''}}</p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>City:</strong> {{!empty($user['city_details']['name'])?$user['city_details']['name']:''}}</p>
                      </div>
                      
                   
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <a href="{{url('admin/user')}}">
                            <input type="button"  class="btn btn-info btn-flat" value="Back">
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

