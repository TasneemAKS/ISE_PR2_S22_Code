<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------

  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  //update teacher info -------------------------------------------------------------------------------------------------
  if(isset($_GET['update_info'])){
     $update_id = $_GET['update_id'];
     $update_name_teacher = $_GET['update_name_teacher'];
     $update_date = $_GET['update_date'];
     $update_number = $_GET['update_number'];

     $update_query = mysqli_query($conn, "UPDATE `techer` SET wname = '$update_name_teacher', wdate = '$update_date', wage = '$update_number' WHERE ID = '$update_id'");
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
        <title>تعديل الملف الشخصي</title>
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
							    <h2 class="ml-lg-2">تعديل معلومات الملف الشخصي</h2>
							 </div>
					     </div>
					   </div>
					   
					   <!-- update teacher info --------------------------------------------------------------------------------------->
				      <?php

				        if(isset($_GET['edit_info'])){
				          $edit_id = $_GET['edit_info'];
				          $edit_query = mysqli_query($conn, "SELECT * FROM `techer` WHERE ID = $edit_id");
				          while($row = $edit_query->fetch_assoc()){
				      ?> 

                       <form method="get" >
                       <input type="hidden" name="update_id" value="<?php echo $row['ID']; ?>">
                
					   <div style ="display: inline-block; text-align: right; width: 70%"class="update-md">
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
					   <br>
						<label><strong>الاسم كاملاً</strong></label>
						<input type="text"  style="text-align:right;" class="form-control" name="update_name_teacher" value="<?php echo $row['wname']; ?>">
						<br>
					
					</div>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>تاريخ الميلاد</strong></label>
                        <input type="date"  style="text-align:right;" class="form-control"  name="update_date" value="<?php echo $row['wdate']; ?>">
						<br>	
					</div>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>العمر</strong></label>
                        <input type="number" style="text-align:right;" class="form-control"  name="update_number" value="<?php echo $row['wage']; ?>">	
					</div>
					<br>
					<br>
					<div style ="display: inline-block; text-align: center; width: 70%">
						<input type="submit" value="تعديل" name="update_info" class="btn btn-success"></div>

				    </form>

				  <?php } }  ?>       
				  </div>
				
				  </div>

					   		   
					   
					   </div>
					</div>					   
					   
					
					
				 
			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
		 <!----footer-design------------->

		 
		 
		 
		 
	  </div>




<!-------complete html----------->





  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>

  
  
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


