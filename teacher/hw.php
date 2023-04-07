<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  // insert homework ---------------------------------------------------------------------------------------------------
  if(isset($_POST["addhw"])){
    $wnameclass=$_POST["wnameclass"];
    $wnamesubject=$_POST["wnamesubject"];
    $file_name =$_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    move_uploaded_file($file_tmp,'../admin/filehw/'.$file_name);
    $file_name_p =$_FILES["file_p"]["name"];
    $file_tmp_p = $_FILES["file_p"]["tmp_name"];
    move_uploaded_file($file_tmp_p,'../picture/'.$file_name_p);
    
    $sql_add_hm = mysqli_query($conn ,"INSERT INTO `hm`(wnameclass, wnamesub, file ,wpicture) VALUES ('$wnameclass','$wnamesubject','$file_name' ,'$file_name_p') ");
    header('Location:hw.php');
  }

  // delete homework ---------------------------------------------------------------------------------------------------
  if(isset($_GET["delet_hw"])){
    $wid=$_GET["delet_hw"];
    $sql_delete_hm = mysqli_query($conn ,"DELETE FROM `hm` WHERE wid = '$wid' ");
    header('location:hw.php');
  }

  // update homework file ----------------------------------------------------------------------------------------------
  if(isset($_POST['update_file'])){
     $update_id = $_POST['update_id_f'];
     $up_file_name = $_FILES["update_file_f"]["name"];
     if ($up_file_name == null) {
       $up_file_name = $_POST['update_old'];
     }
     else{
      unlink('../admin/filehw/'.$_POST['update_old']);
      $up_file_tmp = $_FILES["update_file_f"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'../admin/filehw/'.$up_file_name);
     }

     $update_query = mysqli_query($conn, "UPDATE `hm` SET file = '$up_file_name' WHERE wid = '$update_id'");
     header('location:hw.php');
  }

  // cheack on download homework , here i want to dowload file from file homework ,so i catch the file name ------------->  
  if(isset($_GET['download_homework'])){
    $filename = basename($_GET['download_homework']);
    $filepath = '../admin/filehw/homework solution/' . $filename;

  if(!empty($filename) && file_exists($filepath)){
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
    readfile($filepath); 
    exit; 
  }
  else{ echo 'The file does not exist.'; }
  }

?>
<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>الوظائف</title>
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

	 <?php include('teacher-sidebar.php') ?>
	 
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
							  <span>إضافة ورقة عمل</span>
							  </a>
							</div>
							
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة الوظائف</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
										<div></div>
									<th>العمليات</th>
									<th>تحديث الملف</th>
									<th>صورة الوظيفة</th>
									<th>ملف الوظيفة</th>
									<th>اسم المادة</th>
									<th>الصف</th>
								</tr>
						  </thead>
						   <?php
					          include('../connection.php');

					          $sql_subject = mysqli_query($conn,"SELECT * FROM hm INNER JOIN techer ON techer.wclass = hm.wnameclass WHERE techer.wemail = '$email'" );
					        while($row = $sql_subject->fetch_assoc()){ 
					        ?>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								<label for="checkbox1"></label></td>
								<th>
								   <a href="update_hw.php?edit_hw=<?php echo $row['wid']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i>
								  </a>
								  <a href="hw.php?delet_hw=<?php echo $row['wid']; ?>" class="delete" >
								  <i class="material-icons"  title="حذف">&#xE872;</i>
								  </a>
								</th>
								<td>
									<a href="hw.php?edit_file=<?php echo $row['wid']; ?>" >تحديث</a>
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

			      <!-- update homework file ------------------------------------------------------------------------------------------->
			      <?php

			        if(isset($_GET['edit_file'])){
			          $edit_id = $_GET['edit_file'];
			          $edit_query = mysqli_query($conn, "SELECT * FROM `hm` WHERE wid = $edit_id");
			          while($row = $edit_query->fetch_assoc()){
			      ?> 

			      <form  method="post" enctype="multipart/form-data">
			        <input type="hidden" name="update_id_f" value="<?php echo $row['wid']; ?>">
			        <input type="hidden" name="update_old" value="<?php echo $row['file']; ?>">
			        <input type="file" name="update_file_f"  value="<?php echo $row['file'] ?>">
			        <input type="submit" value="update the file" name="update_file">
			      </form>  

			      <?php } }  ?> 

<!--Solution Section Start-->


				    <div class="col-md-12">
						<div class="table-wrapper">
						  
						<div class="table-title">
						  <div class="row">
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal"data-toggle="modal">
							   </a>
							 </div>
							 
							  <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
								 <h2 class="ml-lg-2">حل الطلاب للوظائف</h2>
							  </div>
						  </div>
						</div>
						
						<table class="table table-striped table-hover">
							 <thead>
								 <tr>
									<th><span class="custom-checkbox">
										<div></div>
									 <th>تحميل</th>
									 <th>ملف الحل</th>
									 <th>اسم المادة</th>
									 <th>اسم الطالب</th>
								 </tr>
						   </thead>
						   <?php
					          include('../connection.php');

					          $sql_subject = mysqli_query($conn,"SELECT * FROM solution INNER JOIN techer ON techer.wclass = solution.wclassname WHERE techer.wemail = '$email'" );
					        while($row = $sql_subject->fetch_assoc()){ 
					        ?>
						   
						   <tbody>
							 <tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								 <th>
									<a href="hw.php?download_homework=<?php echo $row['wfile_hm']; ?>" class="download" download>
										<i class="material-icons" title="تحميل">download</i>
								  </a>
								 </th>
								 <td><?php echo $row['wfile_hm'] ?></td>
								 <td><?php echo $row['wsubject'] ?></td>
								 <th><?php echo $row['wstudent'] ?></th>
								 
							 </tr>

						
							<?php  } ?>
		 
							  
						   </tbody>
						   
						</table>
								   
						
						</div>
					 </div>

<!--Solution Section end-->


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
								  <input type="text" name="wnameclass" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>اسم المادة</label>
								  <input type="text" name="wnamesubject" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>ملف الوظيفة</label>
								  <input type="file"  name="file" multiple required>
							  </div>
							  <div class="form-group">
								  <label>صورة الوظيفة</label>
								  <input type="file"  name="file_p" multiple required>
							  </div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addhw" class="btn btn-success">إضافة</button>
							</div>
						  </div>
						</div>
					  </div>

					<!----add-modal end--------->







					   
				   <!----edit-modal start--------->
<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<div class="close-btn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>
		  <div class="title-btn"><h5 class="modal-title"> تعديل معلومات الوظيفة</h5></div>

      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>الصف</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>اسم المادة</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>صورة الوظيفة</label>
			<input type="file" class="form-control">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-success">حفظ</button>
      </div>
    </div>
  </div>
</div>

					<!----edit-modal end--------->	   

					<!----delete-modal start--------->

					<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
								<div class="close-btn">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button></div>
								  <div class="title-btn"><h5 class="modal-title">حذف وظيفة</h5></div>
							</div>
							<div class="modal-body">
							  <p>هل أنت متأكد من حذف هذه الوظيفة؟</p>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="button" class="btn btn-success">حذف</button>
							</div>
						  </div>
						</div>
					  </div>

						<!----delete-modal end--------->



					   
					
					
				 
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


