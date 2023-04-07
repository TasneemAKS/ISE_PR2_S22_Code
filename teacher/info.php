<?php 

  include('../connection.php');

  session_start();

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------
  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  //update picture -------------------------------------------------------------------------------------------------------
  if(isset($_POST['update_file'])){
   $update_id = $_POST['update_id_i'];
   $up_file_name = $_FILES["update_picture"]["name"];
   if ($up_file_name == null) {
     $up_file_name = $_POST['update_old'];
   }
   else{
    unlink('./picture/'.$_POST['update_old']);
    $up_file_tmp = $_FILES["update_picture"]["tmp_name"];
    move_uploaded_file($up_file_tmp,'./picture/'.$up_file_name);
   }

   $update_query = mysqli_query($conn, "UPDATE `techer` SET wfile = '$up_file_name' WHERE ID = '$update_id'");
   header('location:info.php');
}

 
?>

<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>الملف الشخصي</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">


  </head>

<body>
	<div class="wrapper">
		<div class="body-overlay"></div>
	 
	 <!-------SIDEBAR----------->
	 

	 <?php include('teacher-sidebar.php'); ?>


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
							   <a href="#addEmployeeModal" data-toggle="modal"></a>
							 </div>
							 
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">المعلومات الشخصية</h2>
							 </div>
					     </div>
					   </div>

					   <?php
				        include('../connection.php');
				        $sql_subject = mysqli_query($conn,"SELECT * FROM `techer` WHERE wemail = '$email' " );
				          while($row = $sql_subject->fetch_assoc()){
				      ?>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
									<th>العمليات</th>
									<th>تحديث الصورة الشخصية</th>
									<th>الصورة الشخصية</th>
									<th>العمر</th>
									<th>تاريخ الميلاد</th>
									<th>الجنس</th>
									<th>اسم المدرس</th>
								</tr>
						  </thead>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<th>
								   <a href="update_info.php?edit_info=<?php echo $row['ID']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i>
								<td>
									<a href="info.php?edit_file=<?php echo $row['ID']; ?>" >تحديث</a>
								</td>
								</th>
								<td><img src="picture/<?php echo $row['wfile'] ?>" alt="الصورة الشخصية" width="65"></td>
								<td><?php echo $row['wage'] ?></td>
								<td><?php echo $row['wdate'] ?></td>
								<td><?php echo $row['wGender'] ?></td>
								<th><?php echo $row['wname'] ?></th>
							</tr>

							<th></th>
							 
						  </tbody>
						  
					      <?php  } ?>
					   </table>
					   		   
					   
					   </div>
					</div>	

					      <!-- update picture -------------------------------------------------------------------------------------------->
					      <?php

					        if(isset($_GET['edit_file'])){
					          $edit_id = $_GET['edit_file'];
					          $edit_query = mysqli_query($conn, "SELECT * FROM `techer` WHERE ID = $edit_id");
					          while($row = $edit_query->fetch_assoc()){
					      ?>

					      <form method="post" enctype="multipart/form-data" >
					        <input type="hidden" name="update_id_i" value="<?php echo $row['ID']; ?>">
					        <input type="hidden" name="update_old" value="<?php echo $row['wfile']; ?>">
					        <input type="file" name="update_picture" value="<?php echo $row['wfile']; ?>">
					        <input type="submit" value="update picture" name="update_file"> 
					      </form>

					      <?php } }  ?>				   
					   
					   
				   <!----edit-modal start--------->
<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<div class="close-btn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>
		  <div class="title-btn"><h5 class="modal-title"> تعديل المعلومات الشخصية</h5></div>

      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>الاسم</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>تاريخ الميلاد</label>
			<input type="date" class="form-control">
		</div>
		<div class="form-group">
			<label>الجنس</label><br>
			<select name="gender" id="gender">
			  <option value="female">أنثى</option>
			  <option value="male">ذكر</option>
			</select>
		</div>
		<div class="form-group">
		    <label>العمر</label>
			<input type="number" class="form-control">
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


					   <!----edit-modal end--------->   
					   
					
					
				 
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
   <script src="js/bootstrap.min.js"></script>

  
  
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


