<?php 

  //cheack if admin log in from log in page and session is start , if is not header to log in page ---------------------
  session_start();

  include('../connection.php');

  if (!isset($_SESSION['email'])) {
    header('Location:../admin_login.php');
  }

  //update teacher info -----------------------------------------------------------------------------------------------
  if(isset($_GET['update_teacher'])){
     $update_id = $_GET['update_id'];
     $update_name_teacher = $_GET['update_name_teacher'];
     $update_Gender = $_GET['update_Gender'];
     if ($update_Gender == NULL) {$update_Gender = $_GET['update_Genders'];}
     else{$update_Gender = $_GET['update_Gender'];}
     $update_date = $_GET['update_date'];
     $update_number = $_GET['update_number'];
     $update_email = $_GET['update_email'];
     $update_class = $_GET['update_class'];
     $update_bio = $_GET['update_bio'];
     $update_password = $_GET['update_password'];

     $update_query = mysqli_query($conn, "UPDATE `techer` SET wname = '$update_name_teacher', wGender = '$update_Gender', wdate = '$update_date', wage = '$update_number', wemail ='$update_email',wclass = '$update_class' ,wbio = '$update_bio', wpassword = '$update_password' WHERE ID = '$update_id'");
     header('location:teachers.php');
  }


?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>تعديل المدرس</title>
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
							   <a href="#addEmployeeModal" data-toggle="modal"></a>
							 </div>
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">تعديل معلومات المدرس</h2>
							 </div>
					     </div>
					   </div>
					   
					         <?php

						        if(isset($_GET['edit_teacher'])){
						          $edit_id = $_GET['edit_teacher'];
						          $edit_query = mysqli_query($conn, "SELECT * FROM `techer` WHERE ID = $edit_id");
						          while($row = $edit_query->fetch_assoc()){
						      ?>

                       <form method="get" >
                        <input type="hidden" name="update_id" value="<?php echo $row['ID']; ?>">
                
					   <div style ="display: inline-block; text-align: right; width: 70%"class="update-md">
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>اسم المدرس</strong></label>
						<input type="text" name="update_name_teacher" value="<?php echo $row['wname']; ?>" style="text-align:right;" class="form-control">
						
					</div>
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>الجنس</strong></label><br>
						<input type="radio" id="male" name="update_Gender" value="male"><label for="male">ذكر</label><br>
						<input type="radio" id="female" name="update_Gender" value="female"><label for="female">أنثى</label><br>	
				        <input type="hidden" name="update_Genders" value="<?php echo $row['wGender']; ?>" >


							<br>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
					   <br>
						<label><strong>تاريخ الميلاد</strong></label>
						<input type="date" style="text-align:right;" class="form-control" name="update_date" value="<?php echo $row['wdate']; ?>">
						<br>
					</div>

					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>العمر</strong></label>
						<input type="number" style="text-align:right;" class="form-control" name="update_number" value="<?php echo $row['wage']; ?>">
						
					</div>
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>البريد الالكتروني</strong></label>
						<input type="email" style="text-align:right;" class="form-control" name="update_email" value="<?php echo $row['wemail']; ?>">
						
					</div>
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>الصف</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_class" value="<?php echo $row['wclass']; ?>">
						
					</div>
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>معلومات شخصية</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_bio" value="<?php echo $row['wbio']; ?>">
						
					</div>
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>كلمة السر</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_password" value="<?php echo $row['wpassword']; ?>" >
						
					</div>
					<br>
					<br>
					<div style ="display: inline-block; text-align: center; width: 70%">
						<input type="submit" value="تعديل" name="update_teacher" class="btn btn-success"></div> 

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


