<?php
 session_start();
 if($_SESSION['adminUName']=='')
 {
  header('Location:login.php');
 }
  include_once 'Config.php';
  $id=base64_decode($_GET['id']);
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<script type="text/javascript">
      function readURL(input,d) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image'+d)
                        .attr('src', e.target.result)
                        .width(250)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        } 
</script>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  <!-- Navbar -->
  <?php include_once('includes/header.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once('includes/left.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Service Provider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Service Provider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(isset($msg)){echo $msg;}?>
                 <?php  
                     $query=$mysqli->query("SELECT * FROM service_providers WHERE service_provider_id='$id'");
                     $service_provider_res=$query->fetch_assoc();
					 
					 $cityquery=$mysqli->query("SELECT * FROM city WHERE city_id='".$service_provider_res['present_city']."'");
                     $city_res=$cityquery->fetch_assoc();
					 
					 $cityquery1=$mysqli->query("SELECT * FROM city WHERE city_id='".$service_provider_res['permanent_city']."'");
                     $city_res1=$cityquery1->fetch_assoc();
					 
					 $state=$mysqli->query("SELECT * FROM `state` where state_id='".$service_provider_res['present_state']."'");
                     $state_res=$state->fetch_assoc();
					 
					 $state1=$mysqli->query("SELECT * FROM `state` where state_id='".$service_provider_res['permanent_state']."'");
                     $state_res1=$state1->fetch_assoc();
					 
					 
                   ?>
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
                            <?php if($service_provider_res['service_providers_image']<>''){ ?>
                              <img style="height:120px;" src="images/<?php echo $service_provider_res['service_providers_image'];?>">
                            <?php }else{?>
                             <img style="height:120px;" src="images/profile.jpg">
                            <?php } ?>
                       </div>
                      
                      <div class="form-group">
                      <p class="help-block"><strong>Date:</strong> <?php echo $service_provider_res['service_provider_add_time'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Full Name :</strong> <?php echo $service_provider_res['service_provider_fname'];?>&nbsp; <?php echo $service_provider_res['service_provider_lname'];?></p>
                      </div>
                      

                       <div class="form-group">
                        <p class="help-block"><strong>Phone :</strong> <?php echo $service_provider_res['service_provider_phone'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Specialization :</strong> 
						<?php 
						$sep=$mysqli->query("SELECT * FROM `service_sub_category`");
                     	while($sep_res=$sep->fetch_assoc())
						{
					 	$f=$sep_res['service_sub_category_name']; 
                 	 	$g=$sep_res['service_sub_category_id'];
					 	$c= explode(',',$service_provider_res['specialization']);
						for($i=0;$i<count($c);$i++)
						{ 
							if($c[$i]==$g)
							{ 
								echo  $f.' , '; 
						
							}
						}} ?>
						</p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Date of birth :</strong> <?php echo $service_provider_res['service_provider_dob'];?></p>
                      </div>
                      
                      <div class="form-group">
                        <p class="help-block"><strong>Email :</strong> <?php echo $service_provider_res['service_provider_email'];?></p>
                      </div>

                      <div class="form-group">
                        <p class="help-block"><strong>Gender :</strong> <?php echo $service_provider_res['service_provider_gender'];?></p>
                      </div>
                      
                      

                      <h5><b>Present Address</b></h5>
                      <div class="form-group">
                        <p class="help-block"><strong>State :</strong> <?php echo $state_res['state_name'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>City :</strong> <?php echo $city_res['city_name'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Region:</strong> <?php echo $service_provider_res['present_region'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Pin Code :</strong> <?php echo $service_provider_res['present_pin_code'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Address:</strong></p>
                        <p> <?php echo $service_provider_res['present_address'];?></p>
                      </div>
                          <h5><b>Permanent Address</b></h5>
                      <div class="form-group">
                        <p class="help-block"><strong>State :</strong> <?php echo $state_res1['state_name'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>City :</strong> <?php echo $city_res1['city_name'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Region:</strong> <?php echo $service_provider_res['permanent_region'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Pin Code :</strong> <?php echo $service_provider_res['permanent_pin_code'];?></p>
                      </div>
                      <div class="form-group">
                        <p class="help-block"><strong>Address:</strong> </p>
                        <p><?php echo $service_provider_res['permanent_address'];?></p>
                      </div>

                      
                   
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <a href="service_providers.php">
                            <input type="button" class="btn btn-info btn-flat" value="Back">
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
    <?php echo include_once('includes/footer.php');?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- CK Editor -->
<script src="plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>


<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    
  })
</script>
</body>
</html>
