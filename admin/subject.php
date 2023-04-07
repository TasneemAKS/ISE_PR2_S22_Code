<?php 

  //cheack if admin log in from log in page and session is start , if is not header to log in page ---------------------
  session_start();

  include('../connection.php');

  if (!isset($_SESSION['email'])) {
    header('Location:../admin_login.php');
  }

  // insert subject ----------------------------------------------------------------------------------------------------
  if(isset($_POST["addsubject"])){
    $wnameclass=$_POST["wnameclass"];
    $wnamesubject=$_POST["wnamesubject"];
    $file_name =$_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    move_uploaded_file($file_tmp,'./filesubject/'.$file_name);
    $file_name_p =$_FILES["file_p"]["name"];
    $file_tmp_P = $_FILES["file_p"]["tmp_name"];
    move_uploaded_file($file_tmp_P,'../picture/'.$file_name_p);
    
    $sql_add_subject = mysqli_query($conn ,"INSERT INTO `subject`(wnameclass, wnamesub, file , wpicture) VALUES ('$wnameclass','$wnamesubject','$file_name' ,'$file_name_p') ");
    header('Location:subject.php');
  }

  // delete subject ---------------------------------------------------------------------------------------------------
  if(isset($_GET["delet_subject"])){
    $wid=$_GET["delet_subject"];
    $sql_subject = mysqli_query($conn,"SELECT * FROM subject WHERE wid = '$wid' " );
		while($row = $sql_subject->fetch_assoc()){
    unlink('./filesubject/'.$row['file']);
    }
    $sql_delete_subject = mysqli_query($conn ,"DELETE FROM `subject` WHERE wid = '$wid' ");
    header('location:subject.php');
  }

  // update file subject ---------------------------------------------------------------------------------------------------
  if(isset($_POST['update_file'])){
     $update_id = $_POST['update_id_f'];
     $up_file_name = $_FILES["update_file_f"]["name"];
     if ($up_file_name == null) {
     	$up_file_name=$_POST['update_old'];
     }
     else{
     	unlink('./filesubject/'.$_POST['update_old']);
     	$up_file_tmp = $_FILES["update_file_f"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'./filesubject/'.$up_file_name);
     }
     $update_query = mysqli_query($conn, "UPDATE `subject` SET file = '$up_file_name' WHERE wid = '$update_id'");
     header('location:subject.php');
  }

?>

<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>المواد الدراسية</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">


  </head>

<body>
	<div class="wrapper">
		<div class="body-overlay"></div>
	 
	 <!-------SIDEBAR----------->

	 <?php include('admin-sidebar.php') ?>
	 
	 <!-------SIDEBAR----------->
   
   
   
      <!-------page-content start----------->
   
	<div id="content">
	     
		  <!------top-navbar-start-----------> 
		<div class="top-navbar">
		    <div class="xd-topbar">
			    <div class="row">
					<div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons">signal_cellular_alt</span>
						</div>
					</div> 
				</div>

			</div>
		</div>

		
		  <!------top-navbar-end-----------> 
		  
		  
		   <!------main-content-start-----------> 
		     
		      <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
							<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							  <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
							  <i class="material-icons">&#xE147;</i>
							  <span>إضافة مادة</span>
							  </a>
							</div>
							
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة المواد الدراسية</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
										<div></div>
									<th>العمليات</th>
									<th>تحديث ملف المادة</th>
									<th>صورة المادة</th>
									<th>ملف المادة</th>
									<th>اسم المادة</th>
									<th>الصف</th>
								</tr>
						  </thead>

						  <?php
					        include('../connection.php');
					        $sql_subject = mysqli_query($conn,"SELECT * FROM subject " );
					          while($row = $sql_subject->fetch_assoc()){
					      ?>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								<label for="checkbox1"></label></td>
								<th>
								  <a href="update.php?edit_subject=<?php echo $row['wid']; ?>" class="edit" >
								  <i class="material-icons" title="تعديل">&#xE254;</i>
								  </a>
								  <a href="subject.php?delet_subject=<?php echo $row['wid']; ?>" class="delete">
								  <i class="material-icons" title="حذف">&#xE872;</i>
								  </a>
								</th>
								<td>
							
								<a href="subject.php?edit_file=<?php echo $row['wid']; ?>" >تحديث</a>
									      
								</td>
								<td><img src="../picture/<?php echo $row['wpicture'] ?>" alt="الصورة الشخصية" width="65"></td>
								<td><?php echo $row['file'] ?></td>
								<td><?php echo $row['wnamesub'] ?></td>
								<th><?php echo $row['wnameclass'] ?></th>
							</tr>
							
							 
						  </tbody>
						  <?php  } ?>
					      
					   </table>
					   		   
					   
					   </div>
					</div>	

				  <!-- update on the file  --------------------------------------------------------------------------------------->

			      <?php

			        if(isset($_GET['edit_file'])){
			          $edit_id = $_GET['edit_file'];
			          $edit_query = mysqli_query($conn, "SELECT * FROM `subject` WHERE wid = $edit_id");
			          while($row = $edit_query->fetch_assoc()){
			      ?> 

			      <form  method="post" enctype="multipart/form-data">
			        <input type="hidden" name="update_id_f" value="<?php echo $row['wid']; ?>">
			        <input type="hidden" name="update_old"  value="<?php echo $row['file'] ?>" >
			        <input type="file" name="update_file_f"  value="<?php echo $row['file'] ?>" >
			        <input type="submit" value="update the file" name="update_file">
			        
			      </form>  

			      <?php } }  ?>

					   <!----add-modal end--------->

					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
								<div class="close-btn">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button></div>
								<div class="title-btn"><h5 class="modal-title">إضافة المعلومات اللازمة</h5></div>
							</div>
							<form  action="" method="post" enctype="multipart/form-data">
							<div class="modal-body">
							  <div class="form-group">
								  <label>الصف</label>
								  <input type="text" class="form-control" name="wnameclass" required>
							  </div>
							  <div class="form-group">
								  <label>اسم المادة</label>
								  <input type="text" class="form-control" name="wnamesubject" required>
							  </div>
							  <div class="form-group">
								  <label>ملف المادة</label>
								  <input type="file" id="file" name="file" multiple required>
							  </div>
							  <div class="form-group">
								  <label>صورة المادة</label>
								  <input type="file" id="img" name="file_p" multiple required>
							  </div>							  
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addsubject" class="btn btn-success">إضافة</button>
							</div>
						  </div>
						</div>
					  </div>

					<!----add-modal end--------->


			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
		 <!----footer-design------------->

		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->





  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/script.js"></script>

  
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>
  
  



  </body>
  
  </html>


