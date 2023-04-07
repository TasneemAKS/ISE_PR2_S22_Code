<?php 

  //cheack if admin log in from log in page and session is start , if is not header to log in page ---------------------
  session_start();
  include('../connection.php');
  if (!isset($_SESSION['email'])) {
    header('Location:../admin_login.php');
  }

  //add student -------------------------------------------------------------------------------------------------------
  if(isset($_POST['addstudent'])){

  $wname=$_POST['wname'];

  //check if the user is already exists -------------------------------------------------------------------------------
  $sql_name=mysqli_query($conn,"SELECT * FROM student WHERE wname='$wname' ");
  if(mysqli_num_rows($sql_name) > 0){
    header('Location:students.php?q1=1');
    exit();
  }

  $wGender=$_POST['wGender'];
  $wdate=$_POST['wdate'];
  $wage=$_POST['wage'];
  $wemail=$_POST['wemail'];

  //check if the email is already exists -------------------------------------------------------------------------------
  $sql_email=mysqli_query($conn,"SELECT * FROM student  WHERE wemail='$wemail'");
  if(mysqli_num_rows($sql_email) > 0){
    header('Location:students.php?q1=2');
    exit();
  }

  $wclass=$_POST['wclass'];
  $wfile_name =$_FILES["wfile"]["name"];
  $wfile_tmp = $_FILES["wfile"]["tmp_name"];
  move_uploaded_file($wfile_tmp,'../student/picture/'.$wfile_name);
  $wpassword=$_POST['wpassword'];
  $wpassword2=$_POST['wpassword2'];

  //check if the password is not matching ----------------------------------------------------------------------------
  if($wpassword != $wpassword2 ){
    header('Location:students.php?q1=3');
    exit();
  }

  $sql_insert = mysqli_query($conn, "INSERT INTO `student`(wname, wGender, wdate, wage, wemail, wclass, wfile, wpassword) VALUES ('$wname','$wGender','$wdate','$wage','$wemail','$wclass' ,'$wfile_name','$wpassword') ");
  header('Location:students.php');

  }

  //delete student ----------------------------------------------------------------------------------------------------
  if(isset($_GET["delet_students"])){
    $wid=$_GET["delet_students"];
    $sql_subject = mysqli_query($conn,"SELECT * FROM student WHERE ID = '$wid' " );
		while($row = $sql_subject->fetch_assoc()){
    unlink('../student/picture/'.$row['wfile']);
    }
    $sql_delete_referans = mysqli_query($conn ,"DELETE FROM `student` WHERE ID = '$wid' ");
    header('location:students.php');
  }


  //update student picture --------------------------------------------------------------------------------------------
  if(isset($_POST['update_file'])){
     $update_id = $_POST['update_id_f'];
     $up_file_name = $_FILES["update_file_f"]["name"];
     if ($up_file_name == null) {
       $up_file_name = $_POST['update_old'];
     }
     else{
      unlink('../student/picture/'.$_POST['update_old']);
      $up_file_tmp = $_FILES["update_file_f"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'../student/picture/'.$up_file_name);
     }

     $update_query = mysqli_query($conn, "UPDATE `student` SET wfile = '$up_file_name' WHERE ID = '$update_id'");
     header('location:students.php');
  }

?>

<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>الطلاب</title>
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
	 <?php
    error_reporting(0);
    $q1 = $_GET['q1'];
	if(isset($q1)){
    	if ($q1 == 1) {
    		$message[] = 'user already exist';
    	}
    	elseif ($q1 == 2) {
    		$message[] = 'email already exist';
    	}
    	else{$message[] = 'password not matched';}
      
   }

	if(isset($message)){
	   foreach($message as $message){
	      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
	   };
	};

	?>
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
								<span>إضافة طالب</span>
								</a>
							 </div>
							 
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة قوائم الطلاب</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
									<th>العمليات</th>
									<th>تحديث الصورة الشخصية</th>
									<th>كلمة السر</th>
									<th>الصورة الشخصية</th>
									<th>الصف</th>
									<th>البريد الالكتروني</th>
									<th>العمر</th>
									<th>تاريخ الميلاد</th>
									<th>الجنس</th>
									<th>اسم الطالب</th>
								</tr>
						  </thead>

						  <?php
					        include('../connection.php');
					        $sql_subject = mysqli_query($conn,"SELECT * FROM student" );
					          while($row = $sql_subject->fetch_assoc()){
					      ?>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<th>
								   <a href="update_students.php?edit_students=<?php echo $row['ID']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i></a>

								  <a href="students.php?delet_students=<?php echo $row['ID']; ?>" class="delete" >
								  <i class="material-icons"  title="حذف">&#xE872;</i>
								  </a>
								<td>
									<a href="students.php?edit_file=<?php echo $row['ID']; ?>" >تحديث</a>
								</td>
								</th>
								<td><?php echo $row['wpassword'] ?></td>
								<td><img src="../student/picture/<?php echo $row['wfile'] ?>" alt="الصورة الشخصية" width="65"></td>
								<td><?php echo $row['wclass'] ?></td>
								<td><?php echo $row['wemail'] ?></td>
								<td><?php echo $row['wage'] ?></td>
								<td><?php echo $row['wdate'] ?></td>
								<td><?php echo $row['wGender'] ?></td>
								<th><?php echo $row['wname'] ?></th>
							</tr>
							
							 
						  </tbody>
						  
					    <?php } ?>  
					   </table>
					   		   
					   
					   </div>
					</div>		
					
					      <?php

					        if(isset($_GET['edit_file'])){
					          $edit_id = $_GET['edit_file'];
					          $edit_query = mysqli_query($conn, "SELECT * FROM `student` WHERE ID = $edit_id");
					          while($row = $edit_query->fetch_assoc()){
					      ?> 

					      <form  method="post" enctype="multipart/form-data">
					        <input type="hidden" name="update_id_f" value="<?php echo $row['ID']; ?>">
					        <input type="hidden" name="update_old" value="<?php echo $row['wfile']; ?>">
					        <input type="file" name="update_file_f"  value="<?php echo $row['wfile'] ?>">
					        <input type="submit" value="update the file" name="update_file">
					      </form>  

					      <?php } }  ?>
					
					   <!----add-modal start--------->

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
									<label>اسم الطالب</label>
									<input type="text" name="wname" class="form-control" required>
								</div>
								<div class="form-group">
									<label>الجنس</label><br>
									<select name="wGender" id="wGender" required>
									  <option value="female">أنثى</option>
									  <option value="male">ذكر</option>
									</select>
								</div>
								<div class="form-group">
									<label>تاريخ الميلاد</label>
									<input type="date" name="wdate" class="form-control" required>
								</div>
								<div class="form-group">
									<label>العمر</label>
									<input type="number" name="wage" class="form-control" required>
								</div>
								<div class="form-group">
									<label>البريد الالكتروني</label>
									<input type="text" name="wemail" class="form-control" required>
								</div>
								<div class="form-group">
									<label>الصف</label>
									<input type="text" name="wclass" class="form-control" required>
								</div>
								<div class="form-group">
									<label>الصورة الشخصية</label>
									<input type="file" name="wfile" class="form-control" required>
								</div>
								<div class="form-group">
									<label>كلمة السر</label>
									<input type="text" name="wpassword" class="form-control" required>
								</div>
								<div class="form-group">
									<label>تأكيد كلمة المرور</label>
									<input type="text" name="wpassword2" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addstudent" class="btn btn-success">إضافة</button>
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
		  <div class="title-btn"><h5 class="modal-title">تعديل بيانات الطالب</h5></div>

      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>اسم الطالب</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
			<label>الجنس</label><br>
			<select name="gender" id="gender">
			  <option value="female">أنثى</option>
			  <option value="male">ذكر</option>
			</select>
		</div>
		<div class="form-group">
		    <label>تاريخ الميلاد</label>
			<input type="date" class="form-control">
		</div>
		<div class="form-group">
		    <label>العمر</label>
			<input type="number" class="form-control">
		</div>
		<div class="form-group">
		    <label>البريد الالكتروني</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>الصف</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>المعدل</label>
			<input type="number" class="form-control">
		</div>
		<div class="form-group">
		    <label>كلمة السر</label>
			<input type="text" class="form-control">
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
								  <div class="title-btn"><h5 class="modal-title">حذف طالب</h5></div>
							</div>
							<div class="modal-body">
							  <p>هل أنت متأكد من حذف هذا الطالب؟</p>
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


