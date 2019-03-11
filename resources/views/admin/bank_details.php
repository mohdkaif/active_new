<?php 
  session_start();
  if($_SESSION['adminUName']=='')
  {
    header('Location:login.php');
  }

  include_once 'Config.php';
  if(isset($_GET['bank_id'])){
  $service_provider_id=base64_decode($_GET['bank_id']);
  $_SESSION['service_provider_id']=$service_provider_id;
  }
  
   if(isset($_GET['id']))
    {
      $id=$_GET['id'];
      if($_GET['name']=='e')
      {
          $mysqli->query("update bank_account set account_status='0' where bank_account_id='$id'");
      }
      else if($_GET['name']=='d')
      {
        $mysqli->query("update bank_account set account_status='1' where bank_account_id='$id'");
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script>
    function deletebank_account(id)
    {
      var x = confirm("Are you sure you want to delete?");
    if (x)
      {
         $.ajax({type:'POST',url:'deletebank_details.php',data:{id:id},success:function(result){
     if(result=='yes')
     {
     // alert(result);
     alert("Data has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
     else
     {
     //alert(result);
      alert("Data has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
      }});
      }
      else
      alert("Not Deleted");
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
            <h1>All Bank Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Bank Details</li>
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
               <a href="addbank_details.php" class="btn btn-success btn-flat pull-right">
                  Add Bank Details
                </a>
              </h3>

            </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Bank account number along with IFC code</th>
                   <th>Name of bank</th>
                   <th>Bank account no</th>
                    <th>IFC code</th>
                    <th>Branch Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  
              $query=$mysqli->query("SELECT * FROM bank_account WHERE service_provider_id='".$_SESSION['service_provider_id']."'");
                      if($query->num_rows > 0){
                      while($bank_account_res=$query->fetch_assoc())
                      {
					   ?>
                <tr id="sessiondiv<?php echo $bank_account_res['bank_account_id'];?>">
                  <td><?php echo $bank_account_res['account_holder_name'];?></td>
                  <td><?php echo $bank_account_res['bank_name'];?></td>
                  <td><?php echo $bank_account_res['bank_account_number'];?></td>
                  <td><?php echo $bank_account_res['ifsc_code'];?></td>
                   <td><?php echo $bank_account_res['branch_name'];?></td>
                   <td>
                    <?php
                     $status=$bank_account_res['account_status'];
                      if($status==1)
                      {
                      ?>
                      <a class="btn  btn-success btn-flat" href="bank_details.php?id=<?php echo $bank_account_res['bank_account_id'];?>&name=e" id="Enable">
                      <i class="fa fa-check-square-o"></i>Approved </a>
                      <?php }else{ ?>
                      <a class="btn btn-warning btn-flat" href="bank_details.php?id=<?php echo $bank_account_res['bank_account_id'];?>&name=d" id="Disable">
                      <i class="icon-edit icon-white"></i>  
                      NotApproved                                        
                      </a>
                    <?php } ?>
                  <a href="editbank_details.php?id=<?php echo base64_encode($bank_account_res['bank_account_id']);?>">
                     <button class="btn btn-info btn-flat"><i class="fa fa-edit"></i>Edit</button>
                   </a>
                  <a href="javascript:void(o);" onClick="deletebank_account(<?php echo $bank_account_res['bank_account_id'];?>);">
                  <button class="btn btn-danger btn-flat">Delete</button>
                </a>
                  </td>
                </tr>
               
                 <?php } }else{ ?>
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
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
