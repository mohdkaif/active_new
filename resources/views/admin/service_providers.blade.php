


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Service Provider Request</h1>
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
               <a href="addservice_providers.php" class="btn btn-success btn-flat pull-right">
                  Add Service Providers
                </a>
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
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                  if(!empty($user)){
                @endphp
                @foreach($user as $service_provider_res)
                <tr id="sessiondiv{{$service_provider_res['image']}}">
                  <?php if($service_provider_res['image']){ ?>
                  <td><img style="height:120px;" src="{{url('assets/images/photo/'.$service_provider_res['service_providers_image'])}}"></td>
                  <?php }else{?>
                    <td><img style="height:120px;" src="images/profile.jpg"></td>
                  <?php } ?>
                  
                  <td>{{$service_provider_res['first_name']}} {{$service_provider_res['last_name']}}</td>
                  <td>{{$service_provider_res['email']}}</td>
                  <td>{{$service_provider_res['mobile']}}</td>
                   <td>{{$service_provider_res['gender']}}</td>

                 
                <td>
                    <?php
                     $status=$service_provider_res['status'];
                      if($status=='pending')
                      {
                      ?>
                      <a class="btn  btn-success btn-flat" href="service_providers.php?id={{$service_provider_res['service_provider_id']}}&name=e" id="Enable">
                      <i class="fa fa-check-square-o"></i>Approved </a>
                      <?php }else{ ?>
                      <a class="btn btn-warning btn-flat" href="service_providers.php?id={{$service_provider_res['service_provider_id']}}&name=d" id="Disable">
                      <i class="icon-edit icon-white"></i>  
                      NotApproved                                        
                      </a>
                    <?php } ?>
                 <a href="editservice_providers.php?id={{base64_encode($service_provider_res['service_provider_id'])}}">
                      <button class="btn btn-info btn-flat"><i class="fa fa-edit"></i> Edit</button>
                  </a>
                <a href="viewservice_providers.php?id={{base64_encode($service_provider_res['service_provider_id'])}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-eye"></i> View Details</button>
                </a>
               
                <a href="bank_details.php?bank_id={{base64_encode($service_provider_res['service_provider_id'])}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-university"></i> Bank Details</button>
                </a>
                 <a href="qualification.php?qual_id={{base64_encode($service_provider_res['service_provider_id'])}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-graduation-cap"></i> Qualification</button>
                </a>
                 <a href="upload_doc.php?upload_id={{base64_encode($service_provider_res['service_provider_id'])}}">
                <button class="btn btn-info btn-flat"><i class="fa fa-upload"></i> Upload Document</button>
                </a>
                <a href="javascript:void(o);" onClick="deleteservice_provider({{$service_provider_res['service_provider_id']}});">
                  <button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </a>
                  </td>
                </tr>
                @endforeach
                 <?php }else{ ?>
                          <tr><td colspan="5">No Data(s) found.....</td></tr>
                    <?php } ?>
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
   