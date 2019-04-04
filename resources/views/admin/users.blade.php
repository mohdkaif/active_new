<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Request</h1>
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
        <div class="col-12">
         

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Details
               <!--  <a href="exportenquiry.php" class="btn btn-success btn-flat pull-right">Export All</a> -->
              </h3>

            </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr id="sessiondiv{{$user['id']}}">
                @if(!empty($user['image']))
                  <td><img style="height:60px;" src="{{url('assets/images/users/'.$user['image'])}}"></td>
                @else
                    <td><img style="height:60px;" src="{{url('assets/images/user.png')}}"></td>
                
                @endif
                  <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                  <td>{{!empty($user['email'])?$user['email']:''}}</td>
                  <td>{{$user['mobile']}}</td>
                   <td>{{!empty($user['address'])?$user['address']:''}}</td>

                 
                <td>
                  @if($user['status']=='pending')
                      <a class="btn  btn-success btn-flat"  href="javascript:void(0);"  data-url="{{url(sprintf('admin/user/updatestatus/?id=%s&status=active',$user['id']))}}" data-ask="Are you sure you want to approve user?"  data-ask_image="{{url('assets/default/warning.png')}}" data-request="ajax-confirm" title="Update Status">
                      <i class="fa fa-check-square-o"></i>Approve </a>
                  @else
                      <a class="btn btn-warning btn-flat"  href="javascript:void(0);"  data-url="{{url(sprintf('admin/user/updatestatus/?id=%s&status=pending',$user['id']))}}" data-ask="Are you sure you want to UnApprove user?"  data-ask_image="{{url('assets/default/warning.png')}}" data-request="ajax-confirm" title="Update Status">
                      <i class="icon-edit icon-white"></i> UnApprove               
                      </a>
                  @endif
                <a href="{{url('admin/user/'.base64_encode($user['id']))}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-edit"></i> View User</button>
                </a>
                <a href="{{url('admin/user/view-children/'.base64_encode($user['id']))}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-edit"></i> View Children</button>
                </a>
                <a href="javascript:void(o);" onClick="deleteuser({{$user['id']}});">
                  <button class="btn btn-danger btn-flat">Delete</button>
                </a>
                  </td>
                </tr>
                @endforeach
                {{-- @else
                          <tr><td colspan="5">No Data(s) found.....</td></tr>
                @endif --}}
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
  <!-- /.content-wrapper -->
  