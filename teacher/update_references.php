<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------

  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

  //update referans ----------------------------------------------------------------------------------------------------
  if(isset($_GET['update_referans'])){
     $update_id = $_GET['update_id'];
     $update_name_class = $_GET['update_name_class'];
     $update_name_referans = $_GET['update_name_referans']; 
     if($update_name_referans == NULL)
      {$update_name_referans = $_GET['update_name_referan']; } 
     else {$update_name_referans = $_GET['update_name_referans'];}
     $update_discrebtion = $_GET['update_discrebtion'];
     $update_link = $_GET['update_link']; 

     $update_query = mysqli_query($conn, "UPDATE `referans` SET wnameclass = '$update_name_class', wnameref = '$update_name_referans' , wdiscrebtion = '$update_discrebtion' , wlink = '$update_link'  WHERE wid = '$update_id'");
     header('location:references.php');
  }

?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>تعديل  المرجع</title>
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
							   <a href="#addEmployeeModal" data-toggle="modal"></a>
							 </div>
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">تعديل  معلومات المرجع</h2>
							 </div>
					     </div>
					   </div>
					   
					   <?php

				          if(isset($_GET['edit_referans'])){
				            $edit_id = $_GET['edit_referans'];
				            $edit_query = mysqli_query($conn, "SELECT * FROM `referans` WHERE wid = $edit_id");
				            while($row = $edit_query->fetch_assoc()){
				        ?> 

                       <form method="get" >
                       <input type="hidden" name="update_id" value="<?php echo $row['wid']; ?>">
                
					   <div style ="display: inline-block; text-align: right; width: 70%"class="update-md">
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
					   <br>
						<label><strong>اسم الصف</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_name_class" value="<?php echo $row['wnameclass']; ?>">
						
					</div>


					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>نوع المرجع</strong></label><br>
						<input type="radio" id="video" name="update_name_referans" value="video"><label for="video">فيديو</label><br>
						<input type="radio" id="referan" name="update_name_referans" value="referan"><label for="referan">مرجع</label><br>
						<input type="radio" id="articel" name="update_name_referans" value="articel"><label for="articel">مقال</label><br>	
				        <input type="hidden" name="update_name_referan" value="<?php echo $row['wnameref']; ?>">

							
					   <div style ="display: inline-block; text-align: right; width: 70%"class="group">
					   <br>
						<label><strong>الرابط</strong></label>
						<input type="Link" style="text-align:right;" class="form-control" name="update_link" value="<?php echo $row['wlink']; ?>">
						<br>
					</div>

				
					<div style ="display: inline-block; text-align: right; width: 70%"class="group">
						<label><strong>الوصف</strong></label>
						<input type="text" style="text-align:right;" class="form-control" name="update_discrebtion" value="<?php echo $row['wdiscrebtion']; ?>">
						
					</div>
					<br>
					<br>
					<div style ="display: inline-block; text-align: center; width: 70%">
						<input type="submit" value="تعديل" name="update_referans" class="btn btn-success"></div> 

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


