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


  // cheack on download homework , here i want to dowload file from file homework ,so i catch the file name ------------->
  if(isset($_GET['download_hw'])){
  $filename = basename($_GET['download_hw']);
  $filepath = '../admin/filehw/' . $filename;

  if(!empty($filename) && file_exists($filepath)){
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
    readfile($filepath); 
    exit; 
  }
  else{ echo 'The file does not exist.'; }
  }

  // insert homework file ----------------------------------------------------------------------------------------------
  if(isset($_POST['upload_file'])){
     $namesubject = $_POST['namesubject'];
     $up_file_name = $_FILES["update_file_f"]["name"];
     if ($up_file_name == null) {
       $up_file_name = $_POST['update_old'];
     }
     else{
      unlink('../admin/filehw/homework solution/'.$_POST['update_old']);
      $up_file_tmp = $_FILES["update_file_f"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'../admin/filehw/homework solution/'.$up_file_name);
     }

     $upload_query = mysqli_query($conn, "INSERT INTO `solution`(`wclassname`, `wstudent`, `wsubject`, `wfile_hm`) VALUES ('$class_stu','$name_stu','$namesubject','$up_file_name') ");
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
          $sql_subject = mysqli_query($conn,"SELECT * FROM hm INNER JOIN student ON student.wclass = hm.wnameclass WHERE student.wemail = '$email'" );
        while($row = $sql_subject->fetch_assoc()){ 
        ?>
        <div class="col-xl-5 px-5">
          <div class="card h-100" style="width: 18rem;">
            <h6 class="text-center"><?php echo $row['wnamesub'] ?></h6>
            <img src="../imag/<?php echo $row['wpicture'] ?>" class="card-img-top " alt="...">
            <div class="card-body">
            <a href="page_work.php?download_hw=<?php echo $row['file']; ?>" class="btn btn-primary">تحميل الورقة </a>
            <a href="page_work.php?upload_file=<?php echo $row['wid']; ?>" class="btn btn-success">رفع الحل </a>
            <hr style="color:576CBC;">
            <a href="update_hw.php" class="btn btn-danger">تعديل الحل</a>
            </div>
          </div>
        </div>
        <?php  } ?>
      </div>     
    </div>
  </section>
      <!-- upload_file homework file ------------------------------------------------------------------------------>
    <?php

      if(isset($_GET['upload_file'])){
        $upload_id = $_GET['upload_file'];
        $upload_query = mysqli_query($conn, "SELECT * FROM `hm` WHERE wid = $upload_id");
        while($row = $upload_query->fetch_assoc()){
    ?> 

    <form  method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_id_f" value="<?php echo $row['wid']; ?>">
      <input type="hidden" name="namesubject" value="<?php echo $row['wnamesub']; ?>">
      <?php $subject = $row['wnamesub']; ?>

      <?php

        $upload_query_e = mysqli_query($conn, "SELECT * FROM `solution` WHERE wstudent = '$name_stu' AND wsubject = '$subject'  ");
        while($row = $upload_query_e->fetch_assoc()){
      ?> 
      <input type="hidden" name="update_old" value="<?php echo $row['wfile_hm']; ?>">
      <?php } ?>
      <input type="file" name="update_file_f"  value="<?php echo $row['wfile_hm'] ?>">  
      <input type="submit" value="upload the file" name="upload_file">

    </form>  


    <?php } }  ?> 


  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>