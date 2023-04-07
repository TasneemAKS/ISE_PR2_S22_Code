<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------

  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  // update activite ------------------------------------------------------------------------------------------------
  if(isset($_GET['update_activite'])){
     $update_id = $_GET['update_id'];
     $update_class = $_GET['update_class'];
     $update_wactivite = $_GET['update_wactivite'];
     if ($update_wactivite == NULL) {$update_wactivite = $_GET['update_wactivites']; }
     else{$update_wactivite = $_GET['update_wactivite'];}
     $update_discrebtion = $_GET['update_discrebtion'];
     $update_link = $_GET['update_link']; 

     $update_query = mysqli_query($conn, "UPDATE `activite` SET  class='$update_class' , wtype = '$update_wactivite' , wdiscrebtion = '$update_discrebtion' , wlink = '$update_link'  WHERE wid = '$update_id'");
     header('location:activite.php');
  }


?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>تعديل الأنشطة</title>
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
					   	<!-- update activite --------------------------------------------------------------------------------------->
				        <?php

				          if(isset($_GET['edit_activite'])){
				            $edit_id = $_GET['edit_activite'];
				            $edit_query = mysqli_query($conn, "SELECT * FROM `activite` WHERE wid = $edit_id");
				            while($row = $edit_query->fetch_assoc()){
				        ?>
					     
					   <div class="table-title">
					     <div class="row">
					     	<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" data-toggle="modal"></a>
							 </div>
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">تعديل معلومات الأنشطة</h2>
							 </div>
					     </div>
					   </div>
					   
					   

                       <form method="get" >
                       <input type="hidden" name="update_id" value="<?php echo $row['wid']; ?>">

					   <div style ="display: inline-block; text-align: right; width: 70%"class="update-md">
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
					   <br>
						<label><strong>اسم الصف</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_class" value="<?php echo $row['class']; ?>">
								<br>
					</div>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>نوع النشاط</strong></label><br>
						<input type="radio" id="story" name="update_wactivite" value="story"><label for="story">قصة</label><br>
						<input type="radio" id="art" name="update_wactivite" value="art"><label for="art">فنون</label><br>
						<input type="radio" id="song" name="update_wactivite" value="song"><label for="song">اغنية</label><br>
                        <input type="hidden" name="update_wactivites" value="<?php echo $row['wtype']; ?>">
                        
					</div>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>وصف النشاط</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_discrebtion" value="<?php echo $row['wdiscrebtion']; ?>">
								<br>
					</div>
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>رابط النشاط</strong></label>
						<input type="link" style="text-align:right;" class="form-control" name="update_link" value="<?php echo $row['wlink']; ?>">
								<br>
					</div>
					
					<br>
					<br>
					<div style ="display: inline-block; text-align: center; width: 70%">
						<input type="submit" value="تعديل" name="update_activite" class="btn btn-success"></div>   
				  </div>
				  </div>
				  </form>
				  <?php } }  ?> 
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


