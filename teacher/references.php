<?php 

  //cheack if teacher log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_t'])) {
    header('Location:../teacher_login_form.php');
  }

  $email = $_SESSION['email_t'];

    //add referans ------------------------------------------------------------------------------------------------------
  if(isset($_POST["addreferans"])){
    $wnameclass=$_POST["wnameclass"];
    $wnamereferans=$_POST["wnamereferans"];
    $wdiscrebtion=$_POST["wdiscrebtion"];
    $wlink=$_POST["wlink"];
    $file_name =$_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    move_uploaded_file($file_tmp,'../picture/'.$file_name);

    $sql_add_referanst = mysqli_query($conn ,"INSERT INTO `referans`(wnameclass, wnameref, wdiscrebtion, wlink , wpicture) VALUES ('$wnameclass','$wnamereferans','$wdiscrebtion' , '$wlink' ,'$file_name') ");
    header('Location:references.php');
  } 

  //delete referans ---------------------------------------------------------------------------------------------------
  if(isset($_GET["delet_referans"])){
    $wid=$_GET["delet_referans"];
    $sql_delete_referans = mysqli_query($conn ,"DELETE FROM `referans` WHERE wid = '$wid' ");
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
        <title>المراجع</title>
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
							  <span>إضافة مرجع</span>
							  </a>
							</div>
							
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة المراجع</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
									<div></div>
									<th>العمليات</th>
									<th>الرابط</th>
									<th>الوصف</th>
									<th>صورة المرجع</th>
									<th>نوع المرجع</th>
									<th>الصف</th>
								</tr>
						  </thead>
						  <?php
						          include('../connection.php');
						          $sql_subject = mysqli_query($conn,"SELECT * FROM referans INNER JOIN techer ON techer.wclass = referans.wnameclass WHERE techer.wemail = '$email'" );
						            while($row = $sql_subject->fetch_assoc()){
						        ?>
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								<label for="checkbox1"></label></td>
								<th>
								   <a href="update_references.php?edit_referans=<?php echo $row['wid']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i>
								  </a>
								  <a href="references.php?delet_referans=<?php echo $row['wid']; ?>" class="delete" >
								  <i class="material-icons"  title="حذف">&#xE872;</i>
								  </a>
								</th>
								
								<td><a href="<?php echo $row['wlink'] ?>"><?php echo $row['wlink'] ?></a></td>
								<td><?php echo $row['wdiscrebtion'] ?></td>
								<td><img src="../picture/<?php echo $row['wpicture'] ?>" alt="الصورة الشخصية" width="65"></td>
								<td><?php echo $row['wnameref'] ?></td>
								<th><?php echo $row['wnameclass'] ?></th>
							</tr>
							
							
						  </tbody>
						  
					      <?php  } ?> 
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
							<form  action="" method="post" enctype="multipart/form-data" >
							<div class="modal-body">
								<div class="form-group">
									<label>الصف</label>
									<input type="text" class="form-control" name="wnameclass" required>
								</div>   
								<div class="form-group">
									<label>نوع المرجع</label><br>
									<select  id="wnamereferans" name="wnamereferans" required>
									  <option value="vedio" >فيديو</option>
									  <option value="article" >مقال</option>
									  <option value="refrence" >مرجع</option>
									</select>
								</div>
								<div class="form-group">
									<label>الوصف</label>
									<textarea input type="text" class="form-control" name="wdiscrebtion" required></textarea>
								</div>
								<div class="form-group">
									<label>الرابط</label>
									<input type="link" class="form-control" name="wlink" required>
								</div>
								<div class="form-group">
									<label>صورة المرجع</label>
									<input type="file" class="form-control" name="file" required>
								</div>
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addreferans" class="btn btn-success">إضافة</button>
							</div>
						   
						  </div>
						</div>
					  </div>

					<!----add-modal end--------->
				
				 
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


