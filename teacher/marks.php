<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
  header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  //add mark -----------------------------------------------------------------------------------------------------------
  if(isset($_GET["addmark"])){
  $wnamestudent=$_GET["wnamestudent"];
  $wnamesub=$_GET["wnamesub"];
  $wnameclass=$_GET["wnameclass"];
  $wmark=$_GET["wmark"];
  $wtype=$_GET["wtype"];
  if ($wtype == 'hw') {
    $sql_add_referanst = mysqli_query($conn ,"INSERT INTO `mark`( wnamestudent, wnamesub , wnameclass ,whw) VALUES ('$wnamestudent','$wnamesub', '$wnameclass' ,'$wmark') ");
  header('Location:marks.php');
  }
  else{
    $sql_add_referanst = mysqli_query($conn ,"UPDATE `mark` SET  wexam = '$wmark' WHERE wnamestudent = '$wnamestudent' AND wnamesub = '$wnamesub' ");
  header('Location:marks.php');
  }

  
  }
  
  //delete mark ------------------------------------------------------------------------------------------------------
  if(isset($_GET["delet_mark"])){
  $wid=$_GET["delet_mark"];

  $sql_delete_referans = mysqli_query($conn ,"DELETE FROM `mark` WHERE wid = '$wid' ");
  header('location:marks.php');
  }
  



?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>العلامات</title>
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
							  <span>إضافة علامة</span>
							  </a>
							</div>
							
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة العلامات</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
										<div></div>
									<th>العمليات</th>
									<th>المحصلة</th>
									<th>الامتحان</th>
									<th>الوظيفة</th>
									<th>الصف</th>
									<th>اسم المادة</th>
									<th>اسم الطالب</th>
								</tr>
						  </thead>

              <?php
                include('../connection.php');
                $sql_subject = mysqli_query($conn,"SELECT * FROM mark INNER JOIN techer ON techer.wclass = mark.wnameclass WHERE techer.wemail = '$email'" );
                  while($row = $sql_subject->fetch_assoc()){
              ?>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								<label for="checkbox1"></label></td>
								<th>
								   <a href="update_marks.php?edit_mark=<?php echo $row['wid']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i>
								  </a>
								  <a href="marks.php?delet_mark=<?php echo $row['wid']; ?>" class="delete" >
								  <i class="material-icons"  title="حذف">&#xE872;</i>
								  </a>
								</th>
								<td><?php echo $row['wresult'] ?></td>
								<td><?php echo $row['wexam'] ?></td>
								<td><?php echo $row['whw'] ?></td>
								<td><?php echo $row['wnameclass'] ?></td>
								<td><?php echo $row['wnamesub'] ?></td>
								<th><?php echo $row['wnamestudent'] ?></th>
							</tr>
							
							 
						  </tbody>
						  
              <?php } ?>
					      
					   </table>
					   		   
					   
					   </div>
					</div>	

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
              <form  action="" method="get" >
							<div class="modal-body">
							  <div class="form-group">
								  <label>اسم الطالب</label>
								  <input type="text" name="wnamestudent" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>اسم المادة</label>
								  <input type="text" name="wnamesub" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>الصف</label>
								  <input type="text" name="wnameclass" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>العلامة</label>
								  <input type="number" name="wmark" class="form-control" required>
							  </div>
							  <div class="form-group">
                  <label>نوع العلامة</label><br>
                  <select  id="wtype" name="wtype" required>
                    <option value="hw" >وظيفة</option>
                    <option value="exam" >امتحان</option>
                  </select>
                </div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addmark" class="btn btn-success">إضافة</button>
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
		  <div class="title-btn"><h5 class="modal-title"> تعديل معلومات العلامة</h5></div>

      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>اسم الطالب</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>اسم المادة</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>الصف</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
		    <label>الوظيفة</label>
			<input type="number" class="form-control">
		</div>
		<div class="form-group">
			<label>الامتحان</label>
			<input type="number" class="form-control">
		</div>
		<div class="form-group">
			<label>المحصلة</label>
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

					<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
								<div class="close-btn">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button></div>
								  <div class="title-btn"><h5 class="modal-title">حذف علامة</h5></div>
							</div>
							<div class="modal-body">
							  <p>هل أنت متأكد من حذف هذه العلامة؟</p>
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


