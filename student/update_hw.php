<?php 

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_s'])) {
    header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];
  $class_stu = $_SESSION['class_s'];
  $name_stu = $_SESSION['name_s'];

  // update homework file ----------------------------------------------------------------------------------------------
  if(isset($_POST['update_file'])){
     $update_id = $_POST['update_id_f'];
     $up_file_name = $_FILES["update_file_f"]["name"];
     if ($up_file_name == null) {
       $up_file_name = $_POST['update_old'];
     }
     else{
      unlink('../admin/filehw/homework solution/'.$_POST['update_old']);
      $up_file_tmp = $_FILES["update_file_f"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'../admin/filehw/homework solution/'.$up_file_name);
     }

     $update_query = mysqli_query($conn, "UPDATE `solution` SET wfile_hm = '$up_file_name' WHERE wid = '$update_id'");
     header('location:page_work.php');
  }


?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="./aos/aos.css" rel="stylesheet">
    <link href="./bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/student.css" >
</head>
<body >
 <?php include('student.php'); ?>

    <section id="page_work" class="page_work">
    <div class="container " >  
      <div style="padding-right:12rem;" class=" row row-cols-1 row-cols-md-1 row-cols-lg-2 g-4 ">
        <?php
          include('../connection.php');
          $sql_subject = mysqli_query($conn,"SELECT * FROM solution INNER JOIN student ON student.wclass = solution.wclassname WHERE solution.wstudent = '$name_stu'" );
        while($row = $sql_subject->fetch_assoc()){ 
        ?>
        <div class="col-xl-5 px-5">
          <div class="card h-100" style="width: 18rem;">
            <h6 class="text-center"><?php echo $row['wsubject'] ?></h6>
            <div class="card-body">
            <hr style="color:576CBC;">
            <a href="update_hw.php?update_file=<?php echo $row['wid']; ?>" class="btn btn-danger">تعديل الحل</a>
            </div>
          </div>
        </div>
        <?php  } ?>
      </div>     
    </div>
  </section>

              <!-- upload_file homework file ------------------------------------------------------------------------------>
    <?php

      if(isset($_GET['update_file'])){
        $update_id = $_GET['update_file'];
        $upload_query = mysqli_query($conn, "SELECT * FROM `solution` WHERE wid = $update_id");
        while($row = $upload_query->fetch_assoc()){
    ?>

    <form  method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_id_f" value="<?php echo $row['wid']; ?>">
      <input type="hidden" name="update_old" value="<?php echo $row['wfile_hm']; ?>">
      <input type="file" name="update_file_f"  value="<?php echo $row['wfile_hm'] ?>">
      <input type="submit" value="update the file" name="update_file">
    </form> 

    <?php  } } ?>



  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>