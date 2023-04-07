<?php 

  //cheack if admin log in from log in page and session is start , if is not header to log in page ---------------------
  session_start();

  include('../connection.php');

  if (!isset($_SESSION['email'])) {
    header('Location:../admin_login.php');
  }

    //if admin accepte resgester , then he will add password to user after that the system will add user to student tabel and delete regester from regester tabel -------------------------------------------------------------------------
  if(isset($_GET["update_students"])){
    $wid=$_GET["update_id"];
    $wname=$_GET['wname'];
    $wGender=$_GET['wGender'];
    $wdate=$_GET['wdate'];
    $wage=$_GET['wage'];
    $wemail=$_GET['wemail'];
    $wclass=$_GET['wclass'];
    $wfile=$_GET['wfile'];
    $wpassword=$_GET['update_password'];

    $sql_accept_regester_student = mysqli_query($conn , "INSERT INTO `student` (wname, wGender, wdate, wage, wemail, wclass, wfile , wpassword) SELECT wname, wGender, wdate, wage, wemail, wclass, wfile, \"$wpassword\" FROM `regester` WHERE ID = '$wid' ");
    $sql_delete_regester_student = mysqli_query($conn ,"DELETE FROM `regester` WHERE ID = '$wid' ");
    header('location:user_register.php');
  }



?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>كلمة السر</title>
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
							    <h2 class="ml-lg-2">إضافة كلمة المرور</h2>
							 </div>
					     </div>
					   </div>
					   
					   <?php

				          if(isset($_GET['accept_regester_student'])){
				            $edit_id = $_GET['accept_regester_student'];
				            $edit_query = mysqli_query($conn, "SELECT * FROM `regester` WHERE ID = $edit_id");
				            while($row = $edit_query->fetch_assoc()){
				        ?> 

                       <form method="get" >
                        <input type="hidden" name="update_id" value="<?php echo $row['ID']; ?>">
                
					   <div style ="display: inline-block; text-align: right; width: 70%"class="update-md">
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>كلمة السر</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_password" value="">
						
					</div>
					<br>
					<br>
					<div style ="display: inline-block; text-align: center; width: 70%">
						<input type="submit" value="تعديل" name="update_students" class="btn btn-success"></div> 

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


