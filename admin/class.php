<?php 

  session_start();

  include('../connection.php');

  if (!isset($_SESSION['email'])) {
    header('Location:../admin_login.php');
  }

  // insert class ---------------------------------------------------------------------------------------------------------
  if(isset($_POST["addclass"])){
    $wnumber=$_POST["wnumber"];
    $wname=$_POST["wname"];
    $wage=$_POST["wage"];
    $file_name =$_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    move_uploaded_file($file_tmp,'../imag/'.$file_name);

    $sql_add_class = mysqli_query($conn ,"INSERT INTO `class`(wnumber, wname, wage , wpicture) VALUES ('$wnumber','$wname','$wage' ,'$file_name') ");
    header('Location:class.php');
  }

  // delete class ---------------------------------------------------------------------------------------------------------
  if(isset($_GET["delet"])){
    $wid=$_GET["delet"];
    $sql_delete_class = mysqli_query($conn ,"DELETE FROM `class` WHERE wid = '$wid' ");
    header('location:class.php');
  }

?>


<!doctype html>
<html lang="ar">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>الصف الدراسي</title>
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
							  <span>إضافة صف</span>
							  </a>
							</div>
							
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">إدارة الصفوف</h2>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><span class="custom-checkbox">
										<div></div>
									<th>العمليات</th>
									<th>صورة الصف</th>
									<th>العمر المناسب</th>
									<th>اسم الصف</th>
									<th>رقم الصف</th>
								</tr>
						  </thead>
						    <?php
					          include('../connection.php');
					          $sql_class = mysqli_query($conn,"SELECT * FROM class" );
					            while($row = $sql_class->fetch_assoc()){
					        ?>
						  
						  <tbody>
							<tr>
								<td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="option[]" value="1">
								<label for="checkbox1"></label></td>
								<th>
								   <a href="update_class.php?edit=<?php echo $row['wid']; ?>" class="edit" >
								  <i class="material-icons"  title="تعديل">&#xE254;</i>
								  </a>
								  <a href="class.php?delet=<?php echo $row['wid']; ?>" class="delete" >
								  <i class="material-icons"  title="حذف">&#xE872;</i>
								  </a>
								</th>
								
								<td><img src="../imag/<?php echo $row['wpicture'] ?>" alt="الصورة الشخصية" width="65"></td>
								<td><?php echo $row['wage'] ?></td>
								<td><?php echo $row['wname'] ?></td>
								<th><?php echo $row['wnumber'] ?></th>
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
								  <label>رقم الصف</label>
								  <input type="number" name="wnumber" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>اسم الصف</label>
								  <input type="text" name="wname" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>العمر المناسب</label>
								  <input type="number" name="wage" class="form-control" required>
							  </div>
							  <div class="form-group">
								  <label>صورة الصف</label>
								  <input type="file" id="file"  name="file" multiple required>
							  </div>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							  <button type="submit" name="addclass" class="btn btn-success">إضافة</button>
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


