<?php
 session_start();
 if($_SESSION['adminUName']=='')
 {
  header('Location:login.php');
 }
 include_once 'Config.php';
 global $msg;
 date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s');
  $id=base64_decode($_GET['id']);
  
   //echo $id;exit;
  if(isset($_POST['submit'])){
  
  
  $specialization=$_POST['specialization'];
    $ss='';
    for($i=0;$i<count($_POST['specialization']);$i++)
    {
      if($i==0)
      {
        $ss=$specialization[$i];
      }
      else
      {
        $ss=$ss.','.$specialization[$i];
      }
    }

   if($_FILES['service_providers_image']['name']<>''){
    $res='';
   $ifileext=explode('.',$_FILES['service_providers_image']['name']);
   $ifileext1=$ifileext[count($ifileext)-1];
   if($ifileext1=='jpg' or $ifileext1=='jpeg' or $ifileext1=='png')
   {
    $image_file=time().rand(1111,9999).'.'.$_FILES['service_providers_image']['name'];
   $itarget2 = "images/";
   $itarget2 = $itarget2.$image_file;
   $query=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='$id'");
   if($query->num_rows > 0)
   {
   $res=$query->fetch_assoc();
   $img=$res['service_providers_image'];
   if($img!='')
   {
   $path="images/";
   unlink("$path"."$img");
   }
   }
   move_uploaded_file($_FILES['service_providers_image']['tmp_name'], $itarget2);
   $target_file = $itarget2.basename($_FILES["service_providers_image"]["name"]);

   

   $res=$mysqli->query("UPDATE `service_providers` SET `service_providers_image`='".$image_file."',`specialization`='".$ss."',`service_provider_fname`='".addslashes($_POST['service_provider_fname'])."',`service_provider_lname`='".addslashes($_POST['service_provider_lname'])."',`service_provider_email`='".addslashes($_POST['service_provider_email'])."',`service_provider_password`='".addslashes($_POST['service_provider_password'])."',`service_provider_phone`='".addslashes($_POST['service_provider_phone'])."',`service_provider_dob`='".addslashes($_POST['service_provider_dob'])."',`service_provider_gender`='".addslashes($_POST['service_provider_gender'])."',`present_state`='".addslashes($_POST['present_state'])."',`present_region`='".addslashes($_POST['present_region'])."',`present_pin_code`='".addslashes($_POST['present_pin_code'])."',`present_address`='".addslashes($_POST['present_address'])."',`permanent_state`='".addslashes($_POST['permanent_state'])."',`permanent_region`='".addslashes($_POST['permanent_region'])."',`permanent_pin_code`='".addslashes($_POST['permanent_pin_code'])."',`permanent_address`='".addslashes($_POST['permanent_address'])."',`service_provider_add_time`='".$date."' WHERE `service_provider_id`='$id'");
  }     
  if($res)
  {
  $msg='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button><strong>Well done!</strong> Image succesfully Saved</div>';
   }
   else 
   {
   $msg='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">X</button><strong>Oh snap!</strong> You can upload only png and jpg or jpeg.</div>';   
   }
   }
   elseif($_POST['service_provider_fname']<>'')
   {
   $res=$mysqli->query("UPDATE `service_providers` SET `specialization`='".$ss."',`service_provider_fname`='".addslashes($_POST['service_provider_fname'])."',`service_provider_lname`='".addslashes($_POST['service_provider_lname'])."',`service_provider_email`='".addslashes($_POST['service_provider_email'])."',`service_provider_password`='".addslashes($_POST['service_provider_password'])."',`service_provider_phone`='".addslashes($_POST['service_provider_phone'])."',`service_provider_dob`='".addslashes($_POST['service_provider_dob'])."',`service_provider_gender`='".addslashes($_POST['service_provider_gender'])."',`present_state`='".addslashes($_POST['present_state'])."',`present_region`='".addslashes($_POST['present_region'])."',`present_pin_code`='".addslashes($_POST['present_pin_code'])."',`present_address`='".addslashes($_POST['present_address'])."',`permanent_state`='".addslashes($_POST['permanent_state'])."',`permanent_region`='".addslashes($_POST['permanent_region'])."',`permanent_pin_code`='".addslashes($_POST['permanent_pin_code'])."',`permanent_address`='".addslashes($_POST['permanent_address'])."',`service_provider_add_time`='".$date."' WHERE `service_provider_id`='$id'");
   $msg='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button><strong>Well done!</strong> Data succesfully Saved</div>';
   }
   else
   {
     $msg='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">X</button><strong>Oh snap!</strong> Failed to save Please try again.</div>';   
   }
 }
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
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
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
<script>
  function namevalidate()
   {    
    var name=document.getElementById('service_provider_fname').value;
    var alphaExp = /^[a-zA-Z .]+$/;
    if(name!="" && name.match(alphaExp))
     {
      document.getElementById('service_provider_fname').style.borderColor = "";
      document.getElementById('service_provider_fname').title = "";
     }
     else
     {
        document.getElementById('service_provider_fname').value='';
      document.getElementById('service_provider_fname').style.borderColor = "red";
      document.getElementById('service_provider_fname').title = "Must be alphabet!";
     }
    }
  </script>
<script>
  function number_validate()
   {    
    var name=document.getElementById('number_type').value;
    var alphaExp = /^[0-9.]+$/;
    if(name!="" && name.match(alphaExp))
     {
      document.getElementById('number_type').style.borderColor = "";
      document.getElementById('number_type').title = "";
     }
     else
     {
        document.getElementById('number_type').value='';
      document.getElementById('number_type').style.borderColor = "red";
      document.getElementById('number_type').title = "Must be numerical!";
     }
    }
  </script>
<script>
  function mobilevalidate()
   {    
   
    var mobile=document.getElementById('service_provider_phone').value;
    
    var alphaExp = /^[0-9 +]+$/;
    if(mobile!="" && mobile.match(alphaExp) && mobile.length <= 14 && mobile.length >= 10)
     {
      document.getElementById('service_provider_phone').style.borderColor = "";
      document.getElementById('service_provider_phone').title = "";
     }
     else
     {
        document.getElementById('service_provider_phone').value='';
      document.getElementById('service_provider_phone').style.borderColor = "red";
      document.getElementById('service_provider_phone').title = "Required 10 digits/ Must be Number!";
     }
     
    
    }
  </script>
<script>
  function emailvalidate()
   {
     var email=document.getElementById('service_provider_email').value;
     if(email!="" && email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
     {     
       $.ajax({
         type: "POST",
         data: {email: email},
         url: "emailvalidate.php",
         success: function(msg){
           //alert(msg);
           if(msg=="available")
           {
             document.getElementById('service_provider_email').style.borderColor = "";
             document.getElementById('service_provider_email').title = "";
           }
           else
           {
            document.getElementById('service_provider_email').value='';
            document.getElementById('service_provider_email').style.borderColor = "red";
            document.getElementById('service_provider_email').title = "Email already exists!";
           }
           }
         });    
     }
     else
      {
        document.getElementById('service_provider_email').value='';
      document.getElementById('service_provider_email').style.borderColor = "red";
      document.getElementById('service_provider_email').title = "Must be email!";
      }
  }
  </script>
<script>
  function passvalidate()
   {   
    var pass=document.getElementById('passworduser').value;
    var cpass=document.getElementById('cpasswordUser').value;
     var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/;
    var len=pass.length;
    if(len!='' && pass.match(re))
    {
      document.getElementById('passworduser').style.borderColor = "";
      document.getElementById('passworduser').title = "";
    }
    else
    {
      document.getElementById('passworduser').value='';
      document.getElementById('cpasswordUser').value='';
      document.getElementById('passworduser').style.borderColor = "red";
      document.getElementById('passworduser').title = "The password must be contain At least eight characters, one small letter, one Captial Letter, One Numerical digit.";
      
    }
  }
     
  function onFocusev()
  {
    document.getElementById('cpasswordUser').value='';
    document.getElementById('passworduser').value='';
  }
  
  function conformval()
  {  
    var cpass=document.getElementById('cpasswordUser').value;
    var pass=document.getElementById('passworduser').value;
    var len=cpass.length;
    if(len!=0)
    {
      if(cpass==pass)
       {
        document.getElementById('passworduser').style.borderColor = "";
        document.getElementById('passworduser').title = "";
        document.getElementById('cpasswordUser').style.borderColor = "";
        document.getElementById('cpasswordUser').title = "";
       }
       else
       {
        document.getElementById('cpasswordUser').value='';
        document.getElementById('cpasswordUser').style.borderColor = "red";
       }
    }
    else
      {
        document.getElementById('cpasswordUser').value='';
        document.getElementById('cpasswordUser').style.borderColor = "red";
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
            <h1>Edit  Service Providers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"> Service Providers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(isset($msg)){echo $msg;}?>
                  <?php  
                	 $service_provider=$mysqli->query("SELECT * FROM service_providers WHERE service_provider_id='$id'");
                     $service_provider_res=$service_provider->fetch_assoc();
					 
					 $cityquery=$mysqli->query("SELECT * FROM city WHERE city_id='".$service_provider_res['present_city']."'");
                     $city_res=$cityquery->fetch_assoc();
					 
					 $cityquery1=$mysqli->query("SELECT * FROM city WHERE city_id='".$service_provider_res['permanent_city']."'");
                     $city_res1=$cityquery1->fetch_assoc();
                   ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
               Edit Details
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image</label><br/>
                         <input type="file" name="service_providers_image" onChange="readURL(this,1);">
                         <p class="help-block">You can upload only png and jpg or jpeg.</p>

                         <?php if($service_provider_res['service_providers_image']){ ?>
                  <img id="image1" height="200px;" width="250px;" src="images/<?php echo $service_provider_res['service_providers_image'];?>">
                  <?php }else{?>
                    <img id="image1" height="200px;" width="250px;" src="images/profile.jpg">
                  <?php } ?>

                          
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                           <input type="text" id="service_provider_fname" onBlur="namevalidate(this.value)" autocomplete="off" name="service_provider_fname" value="<?php echo $service_provider_res['service_provider_fname'];?>" placeholder="First Name *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Phone number</label>
                           <input type="text" name="service_provider_phone" value="<?php echo $service_provider_res['service_provider_phone'];?>" id="service_provider_phone" onBlur="mobilevalidate(this.value)" autocomplete="off" placeholder=" Phone number *" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Date of birth</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                              </div>
                                 <input type="text" class="form-control" name="service_provider_dob" value="<?php echo $service_provider_res['service_provider_dob'];?>" autocomplete="off" id="start_datepicker" placeholder="DD-MM-YY" required>
                           </div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                           <input type="password" name="service_provider_password" value="<?php echo $service_provider_res['service_provider_password'];?>" onBlur="passvalidate(this.value)" id="passworduser"  autocomplete="off" placeholder=" Password *" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                           <input type="text" id="service_provider_lname" value="<?php echo $service_provider_res['service_provider_lname'];?>" autocomplete="off" name="service_provider_lname" placeholder="Last Name *" class="form-control">
                      </div>
                     
                       <div class="form-group">
                          <label>Specialization</label>
                          <select class="form-control select2" name="specialization[]"  multiple="multiple" data-placeholder="Select Specialization" style="width: 100%;" required>
                            <?php 
                              $sep=$mysqli->query("SELECT * FROM `service_sub_category`");
                              if($sep->num_rows>0)
                              {
                                while($sep_res=$sep->fetch_assoc())
                                {
									$f=$sep_res['service_sub_category_name']; 
                 					$g=$sep_res['service_sub_category_id'];
									$c= explode(',',$service_provider_res['specialization']);
                              ?>
                               
                                
                                 <option value="<?php echo $g;?>" <?php for($i=0;$i<count($c);$i++){ if($c[$i]==$g){ ?> selected="selected" <?php }} ?> >
								 <?php echo $f;?>
                                 </option> 
                             <?php }}?>
                          </select>
                        </div>

                      <div class="form-group">
                        <label>Email</label>
                           <input type="email" onBlur="emailvalidate(this.value)" id="service_provider_email" name="service_provider_email" value="<?php echo $service_provider_res['service_provider_email'];?>" autocomplete="off" placeholder=" Email *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Re-Password</label>
                           <input type="password" name="re-password" value="<?php echo $service_provider_res['service_provider_password'];?>" autocomplete="off" onBlur="conformval();" id="cpasswordUser" placeholder=" Re-Password *" required class="form-control">
                      </div>

                    </div>
                    <div class="col-md-12">
                       <div class="form-group">
                        <label>Gender</label><br/>
                          <label>
                            <input type="radio" name="service_provider_gender" <?php if($service_provider_res['service_provider_gender']=='Male'){ ?> checked <?php }?> value="<?php echo $service_provider_res['service_provider_gender']; ?>" class="Male" >
                                Male
                          </label>
                          <label>
                            <input type="radio" name="service_provider_gender" <?php if($service_provider_res['service_provider_gender']=='Female'){ ?> checked <?php }?> value="<?php echo $service_provider_res['service_provider_gender']; ?>" class="Female">
                              Female
                          </label>
                          <label>
                            <input type="radio" name="service_provider_gender" <?php if($service_provider_res['service_provider_gender']=='Other'){ ?> checked <?php }?> value="<?php echo $service_provider_res['service_provider_gender']; ?>" class="Other">
                            Other
                          </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <h5><b>Present Address</b></h5>
                      </div>
                      <div class="form-group">
                        <label>State</label>
                           <select class="form-control" name="present_state"  readonly>
                              <?php 
                                $state=$mysqli->query("SELECT * FROM `state` where state_id='".$service_provider_res['present_state']."'");
                                if($state->num_rows>0)
                                {
                                  while($state_res=$state->fetch_assoc())
                                  {
                                ?>
                                 <option <?php if($state_res['state_id']==$service_provider_res['present_state']){ ?> selected <?php }?> value="<?php echo $state_res['state_id']; ?>"><?php echo $state_res['state_name']; ?>
                                </option> 
                              
                                <?php }}?>
                            </select>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text"  value="<?php echo $city_res['city_name'];?>" class="form-control" readonly>
                          
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                           <input type="text" name="present_region"  value="<?php echo $service_provider_res['present_region'];?>" autocomplete="off" placeholder=" Region *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Pin Code</label>
                           <input type="text" name="present_pin_code" value="<?php echo $service_provider_res['present_pin_code'];?>" autocomplete="off" placeholder="Pin Code *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Present Address</label>
                           <textarea name="present_address"  autocomplete="off" placeholder="&nbsp;&nbsp;Present Full address" style="resize: none;" rows="4" cols="70"><?php echo $service_provider_res['present_address'];?></textarea>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <h5><b>Permanent  Address</b></h5>
                      </div>
                      <div class="form-group">
                        <label>State</label>
                           <select class="form-control" name="permanent_state"  readonly/>
                              <?php 
                                $state=$mysqli->query("SELECT * FROM `state` where state_id='".$service_provider_res['permanent_state']."'");
                                if($state->num_rows>0)
                                {
                                  while($state_res=$state->fetch_assoc())
                                  {
                                ?>
                                 <option <?php if($state_res['state_id']==$service_provider_res['permanent_state']){ ?> selected <?php }?> value="<?php echo $state_res['state_id']; ?>"><?php echo $state_res['state_name']; ?></option> 
                              
                                <?php }}?>
                            </select>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text"  value="<?php echo  $city_res1['city_name'];?>" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                           <input type="text" autocomplete="off" name="permanent_region" value="<?php echo $service_provider_res['permanent_region'];?>" placeholder=" Region *" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Pin Code</label>
                           <input type="text" autocomplete="off" name="permanent_pin_code" value="<?php echo $service_provider_res['permanent_pin_code'];?>" placeholder="Pin Code *" required class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>Permanent Address</label>
                           <textarea  name="permanent_address" autocomplete="off" placeholder="&nbsp;&nbsp;Permanent Full address" style="resize:none;" required rows="4" cols="70"><?php echo $service_provider_res['permanent_address'];?></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-success btn-flat">Submit</button>
                          <a href="service_providers.php">
                            <input type="button" class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
                          </a>
                      </div>
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

<script type="text/javascript">
  
    //Initialize Select2 Elements
    $('.select2').select2()
 
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
   $(document).ready(function() {
        $("#start_datepicker").datepicker();
  });
  </script>
<!-- Page script -->
<!-- <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

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

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script> -->


</body>
</html>
