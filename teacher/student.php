<?php 

  include('../connection.php');

  session_start();

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------
  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];
  $class = $_SESSION['class_t'];
 
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
							    <h2 class="ml-lg-2">إدارة قوائم الطلاب</h2>
							 </div>
					     </div>
					   </div>

					   
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
									<th></th>
									<th>E-mail</th>
									<th>الصورة الشخصية</th>
									<th>العمر</th>
									<th>تاريخ الميلاد</th>
									<th>الجنس</th>
									<th>اسم الطالب</th>
								</tr>
						  </thead>
						  <?php
					        include('../connection.php');
					        $sql_subject = mysqli_query($conn,"SELECT student.wname , student.wGender , student.wdate , student.wage , student.wemail , student.wclass , student.wfile FROM `student` WHERE student.wclass = '$class' " );
					          while($row = $sql_subject->fetch_assoc()){
					      ?>
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<th>
							    <td><?php echo $row['wemail'] ?></</td>
								</th>
								<td><img src="../imag/<?php echo $row['wfile'] ?>" alt="الصورة الشخصية" width="65"></td>
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


