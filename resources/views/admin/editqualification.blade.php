
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Qualifications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Qualifications</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(isset($msg)){echo $msg;}?>
                  <?php  
                     $query=$mysqli->query("SELECT * FROM qualifications WHERE qualification_id='$id'");
                     $qualifications_res=$query->fetch_assoc();
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

                      
                     <div class="form-group">
                        <label class="col-sm-6 control-label">Qualification Name</label>
                        <div class="col-sm-6">
                          <select class="form-control" name="qualification_name" required readonly>
                              <option <?php if($qualifications_res['qualification_name']){ ?> selected <?php }?> value="<?php echo $qualifications_res['qualification_name'];?>"><?php echo $qualifications_res['qualification_name'];?></option>
                              
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Qualification Year</label>
                        <div class="col-sm-6">
                          <select class="form-control" name="qualification_year" required readonly>
                               <option <?php if($qualifications_res['qualification_year']){ ?> selected <?php }?> value="<?php echo $qualifications_res['qualification_year'];?>"><?php echo $qualifications_res['qualification_year'];?></option>
                              
                          </select>
                        </div>
                    </div>

                   
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success btn-flat">Submit</button>
                          <a href="qualification.php">
                            <input type="button" class="btn btn-info btn-flat" value="Back" style="margin-left:10px;">
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
   