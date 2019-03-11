<?php 
session_start();
include_once("config.php");
$date = date('Y-m-d H:i:s');
if($_SESSION['service_provider_id']=='')
{
	header('Location: login.php');
}

$provider=$mysqli->query("SELECT * FROM `service_providers` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
$provider_res=$provider->fetch_assoc();

if(isset($_POST['add_doc']))
  {
    $res='';
    if($_FILES['doc_file']['name']<>''){
        $ifileext=explode('.',$_FILES['doc_file']['name']);
        $ifileext1=$ifileext[count($ifileext)-1];
        if($ifileext1=='jpg' or $ifileext1=='docx' or $ifileext1=='doc' or $ifileext1=='pdf' or $ifileext1=='jpeg' or $ifileext1=='png'){
        $image_file='admin/upload_doc/'.time().rand(1111,9999).'.'.$ifileext1;
        $itarget2 = "";
        $itarget2 = $itarget2.$image_file;
        move_uploaded_file($_FILES['doc_file']['tmp_name'], $itarget2);
        $target_file = $itarget2.basename($_FILES["doc_file"]["name"]);
		$image_file='../'.$image_file;
          
        $res=$mysqli->query("INSERT INTO `upload_doc`(`doc_file`,`doc_name`,`service_provider_id`) VALUES ('".$image_file."','".addslashes($_POST['doc_name'])."','".$_SESSION['service_provider_id']."')");
      }
   }    
    if($res)
    {
   $msg='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button><strong> Well done!</strong> Data succesfully Saved</div>';
    }
    else
    {
     $msg='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">X</button><strong>Oh snap!</strong> Failed to save Please try again.</div>';   
    }
  } 
  
  if(isset($_POST['edit_doc'])){
	  $id=addslashes($_POST['doc_id']);
	  
   if($_FILES['doc_file']['name']<>''){
    $res='';
   $ifileext=explode('.',$_FILES['doc_file']['name']);
   $ifileext1=$ifileext[count($ifileext)-1];
   if($ifileext1=='jpg' or $ifileext1=='docx' or $ifileext1=='doc' or $ifileext1=='pdf' or $ifileext1=='jpeg' or $ifileext1=='png')
   {
    $image_file='admin/upload_doc/'.time().rand(1111,9999).'.'.$ifileext1;
        $itarget2 = "";
   $itarget2 = $itarget2.$image_file;
   $query=$mysqli->query("SELECT * FROM `upload_doc` WHERE `doc_id`='$id'");
   if($query->num_rows > 0)
   {
   $res=$query->fetch_assoc();
   $img=$res['doc_file'];
   if($img!='')
   {
   $path="images/";
   unlink("$path"."$img");
   }
   }
   move_uploaded_file($_FILES['doc_file']['tmp_name'], $itarget2);
   $target_file = $itarget2.basename($_FILES["doc_file"]["name"]);
   $image_file='../'.$image_file;
   
   $res=$mysqli->query("UPDATE `upload_doc` SET `doc_file`='".$image_file."',`doc_name`='".addslashes($_POST['doc_name'])."' WHERE `doc_id`='$id' and `service_provider_id`='".$_SESSION['service_provider_id']."'");
  }     
  if($res)
  {
  $msg='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button><strong>Well done!</strong> Data succesfully Saved</div>';
   }
   else 
   {
   $msg='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">X</button><strong>Oh snap!</strong>  Failed to save Please try again.</div>';   
   }
   }
   elseif($_POST['doc_name']<>'')
   {
    $res=$mysqli->query("UPDATE `upload_doc` SET `doc_name`='".addslashes($_POST['doc_name'])."' WHERE `doc_id`='$id' and `service_provider_id`='".$_SESSION['service_provider_id']."'");
   $msg='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button><strong>Well done!</strong> Data succesfully Saved</div>';
   }
   else
   {
     $msg='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">X</button><strong>Oh snap!</strong> Failed to save Please try again.</div>';   
   }
 }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
     <title>WELCOME TO THE ACTIVE BACCHA</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <!-- Stylesheets -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      
      <link href="css/style.css" rel="stylesheet">
     
      <link href="css/responsive.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Responsive -->
      <style>
         .icon-box i {
    font-size: 77px;
}
      </style>
      <style>
         
body .modal-backdrop.in {
  transition: all 0.4s;
    filter: alpha(opacity=1);
    opacity: 1;
    background-color: #fff;
}
.contactPopupPanel{
  border-radius: 0px;
}

.contactPopupPanel .modal-content{
  border-radius: 0px;
  background: #fff;
  max-width: 700px;
  margin: auto;
  box-shadow: none;
  border: none;
}

body .modal-backdrop.in {
  transition: all 0.4s;
    filter: alpha(opacity=1);
    opacity: 1;
    background-color: #fff;
}
.contactPopupPanel .modal-content .modal-body{
  padding: 20px 30px;
}
#wrapper .contactPopupPanel .modal-content .ht3{
  color: #333;
  text-transform: uppercase;
}
#wrapper .contactPopupPanel .modal-content .ht6{
  margin-bottom: 20px;
  color: #333;
}  
.contactPopupPanel .modal-content .modal-header .close {
    margin-top: -4px;
    font-size: 40px;
    color: #3db8b7 !important;
}
.contactPopupPanel .modal-content .form-group{
  margin-bottom: 20px;
}
.contactPopupPanel .modal-content label{
  font-weight: 300;
  margin: 0px;
}
.contactPopupPanel .modal-content .contactSub{
  margin-top: 0;
  line-height: normal;
  font-weight: 500;
  font-size: 17px;
  
  color: #fff;
  background: #e96036;
  text-transform: uppercase;
  
  height: inherit;
}
.contactPopupPanel .modal-content .contactSub:hover{
  margin-top: 0;
  line-height: normal;
  font-weight: 500;
  font-size: 17px;
  text-transform: uppercase;
  background: #3db8b7;
  color: #fff;
  height: inherit;
}

      </style>
      <?php include_once("function_validation.php");?>
   </head>
   <body>
      </head>
      <body>
         <div class="page-wrapper">
            <!-- Main Header-->
            <!--End Main Header -->
            <!--Main Slider-->
           
         <div id="wrapper">
             <section class="">
               <?php include_once("include/header.php"); ?>
        
         </section>
      <div class="page-wrapper">
         <!-- Main Header-->
         <!--End Main Header -->
         <!--Main Slider-->
         <section class="page-title" style="background: #31697f; height: 300px">
         
            <div class="auto-container">
               
       <h1 style="color:#f0eeee;">Welcome <span class="text-sky" style="color: #e88060!important;">  <?php echo $provider_res['service_provider_fname'].' '.$provider_res['service_provider_lname'];?></span></h1>
            </div>
         </section>
      <?php include('dashabord-slider.php') ?>
      <?php if(isset($msg)){ echo $msg ;} ?>
    <section class="gallery-full-width style-two" style="background: #f4f4f4">
        <div class="mixitup-gallery">
          <div class="auto-container">
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    
                
            </div>
                </div>
                <br>
                <div class="row" style="padding: 10px;border: 1px solid #f6f6f6;padding: 15px;    background: #fff;box-shadow: aliceblue;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                 
                    <div class="table-responsive ">
                         <table class="table" >
                            <tr>
                                 <td><p>All Upload Doc</p></td>
                                <td> <div class="upload-btn-wrapper">
                              <a href="#add_doc" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-default pull-right">Add Upload Document</a>
							</div>
						</td>
                            </tr>
                         </table>
                        <table class="table table-bordered" border="1"  style="padding: 15px;    background: #fff;box-shadow: aliceblue;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <thead>
                                <tr >
                                    <th class="text-center">Document File </th>
                                    <th class="text-center">Document Name</th>
                                     <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
							$doc=$mysqli->query("SELECT * FROM `upload_doc` WHERE `service_provider_id`='".$_SESSION['service_provider_id']."'");
							if($doc->num_rows>0)
							{
								while($doc_res=$doc->fetch_assoc())
								{
							?>
                                <tr id="sessiondiv<?php echo $doc_res['doc_id'];?>">
                                <td class="text-center"><a href="active-baccha/<?php echo $doc_res['doc_file'];?>" download><img src="images/doc.jpg" style="max-height: 100px;width: 100px"></a></td>
                                <td class="text-center"><?php echo $doc_res['doc_name'];?></td>
                                <?php if($doc_res['doc_status']==1){ ?>
                                <td class="text-center" style="color: #4eb20c">APPROVED</td>
                                <?php }else {?>
                                <td class="text-center" style="color: #e96036">PANDING</td>
                                <?php }?>
                               
                                <td class="text-center">	
                                 <a href="#edit_doc<?php echo $doc_res['doc_id'];?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false"class="btn btn-s1">				
                                <i class="fa fa-pencil"></i></a>
                                 &nbsp 
                                 <a href="javascript:void(o);" onClick="deleteupload_doc(<?php echo $doc_res['doc_id'];?>);">
                                 <button class="btn btn-s2"><i class="fa fa-trash"></i></button></a> 
                               </td>
                                </tr>
                                <div id="edit_doc<?php echo $doc_res['doc_id'];?>" class="contactPopupPanel modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="ht4 text-center">Upload Document 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </h3>
            </div>
            <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
              <div class="col-md-12">
              <label>Document Name </label>               
                <div class="form-group">
                  <select  name="doc_name" class="form-control"  required="required" >
                    <option value="">Select</option>
  					<option <?php if($doc_res['doc_name']=='Xth Marksheet'){ echo 'selected';}?> value="Xth Marksheet">Xth Marksheet</option>
  					<option <?php if($doc_res['doc_name']=='XIIth Marksheet'){ echo 'selected';}?> value="XIIth Marksheet">XIIth Marksheet</option>
  					<option <?php if($doc_res['doc_name']=='Graduation Marksheet'){ echo 'selected';}?> value="Graduation Marksheet" >Graduation Marksheet</option>
                    <option <?php if($doc_res['doc_name']=='Post Graduation Marksheet'){ echo 'selected';}?> value="Post Graduation Marksheet">Post Graduation Marksheet</option>
  					<option <?php if($doc_res['doc_name']=='Adhar Card'){ echo 'selected';}?> value="Adhar Card">Adhar Card</option>
                    <option <?php if($doc_res['doc_name']=='Pan Card'){ echo 'selected';}?> value="Pan Card">Pan Card</option>
                    <option <?php if($doc_res['doc_name']=='Driving Licence'){ echo 'selected';}?> value="Driving Licence">Driving Licence</option>
                    <option <?php if($doc_res['doc_name']=='Passport Copy'){ echo 'selected';}?> value="Passport Copy">Passport Copy</option> 
                    <option <?php if($doc_res['doc_name']=='Police Verification'){ echo 'selected';}?> value="Police Verification">Police Verification</option>
				  </select>
                </div>
              </div>
              <div class="col-md-12">
              <label>Document File</label>               
                <div class="form-group">
                  <input type="file" name="doc_file" class="form-control"  required="required" />
                  <input type="hidden" name="doc_id" value="<?php echo $doc_res['doc_id'];?>" class="form-control"  required="required" />
                </div>
              </div>
              
              <div class="col-md-12">    
                <div class="form-group" style="margin-bottom: 0;">
                  <input type="submit" name="edit_doc" class="btn btn-why btn-lg form-control contactSub" value="Submit" />
                </div>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>
                                
                             <?php }}?>
                                
                            </tbody>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
                
            </div>
              
          </div>
        </div>
    </section>
    
    <div id="add_doc" class="contactPopupPanel modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="ht4 text-center">Upload Document 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </h3>
            </div>
            <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
              <div class="col-md-12">
              <label>Document Name </label>               
                <div class="form-group">
                  <select  name="doc_name" class="form-control"  required="required" >
                    <option value="">Select</option>
  					<option value="Xth Marksheet">Xth Marksheet</option>
  					<option value="XIIth Marksheet">XIIth Marksheet</option>
  					<option value="Graduation Marksheet">Graduation Marksheet</option>
                    <option value="Post Graduation Marksheet">Post Graduation Marksheet</option>
  					<option value="Adhar Card">Adhar Card</option>
                    <option value="Pan Card">Pan Card</option>
                    <option value="Driving Licence">Driving Licence</option>
                    <option value="Passport Copy">Passport Copy</option> 
                    <option value="Police Verification">Police Verification</option>
				  </select>
                </div>
              </div>
              <div class="col-md-12">
              <label>Document File</label>               
                <div class="form-group">
                  <input type="file" name="doc_file" class="form-control"  required="required" />
                </div>
              </div>
              
              <div class="col-md-12">    
                <div class="form-group" style="margin-bottom: 0;">
                  <input type="submit" name="add_doc" class="btn btn-why btn-lg form-control contactSub" value="Submit" />
                </div>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>
        
 <?php include_once("include/footer.php"); ?>
         </div>
         <!--End pagewrapper-->
         <!--Scroll to top-->
         <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
          <script src="js/price_range_script.js" type="text/javascript"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

         <script src="js/demo.js"></script>
         <script src="js/jquery.fancybox.js"></script>
         <script src="js/appear.js"></script>
         <script src="js/mixitup.js"></script>
         <script src="js/owl.js"></script>
         <script src="js/wow.js"></script>
         <script src="js/script.js"></script>
          <script src="js/multislider.js"></script>
     

        
         <script type="text/javascript">
          
            $('.burger, .overlay').click(function(){
            $('.burger').toggleClass('clicked');
            $('.overlay').toggleClass('show');
            $('nav').toggleClass('show');
            $('body').toggleClass('overflow');
            });
          
    $('.mixedSlider').multislider({
      duration: 1000,
      interval: 6000,
    });

         </script>
         <script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
   $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
   $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
   $("#profile-img").removeClass();
   $("#status-online").removeClass("active");
   $("#status-away").removeClass("active");
   $("#status-busy").removeClass("active");
   $("#status-offline").removeClass("active");
   $(this).addClass("active");
   
   if($("#status-online").hasClass("active")) {
      $("#profile-img").addClass("online");
   } else if ($("#status-away").hasClass("active")) {
      $("#profile-img").addClass("away");
   } else if ($("#status-busy").hasClass("active")) {
      $("#profile-img").addClass("busy");
   } else if ($("#status-offline").hasClass("active")) {
      $("#profile-img").addClass("offline");
   } else {
      $("#profile-img").removeClass();
   };
   
   $("#status-options").removeClass("active");
});

function newMessage() {
   message = $(".message-input input").val();
   if($.trim(message) == '') {
      return false;
   }
   $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
   $('.message-input input').val(null);
   $('.contact.active .preview').html('<span>You: </span>' + message);
   $(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});
//# sourceURL=pen.js
</script>
   </body>
</html>