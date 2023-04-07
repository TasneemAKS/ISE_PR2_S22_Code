<?php 

  include('../connection.php');

  session_start();

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  if (!isset($_SESSION['email_s'])) {
    header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];
  $class = $_SESSION['class_s'];

  //update student info -------------------------------------------------------------------------------------------------
  if(isset($_POST['update_info'])){
     $update_name_student = $_POST['update_name_student'];
     $update_wGender = $_POST['update_wGender'];
     $update_date = $_POST['update_date'];         
     $update_number = $_POST['update_number'];
     $up_file_name = $_FILES["update_picture"]["name"];
     if ($up_file_name == null) {
       $up_file_name = $_POST['update_old'];
     }
     else{
      unlink('./picture/'.$_POST['update_old']);
      $up_file_tmp = $_FILES["update_picture"]["tmp_name"];
      move_uploaded_file($up_file_tmp,'./picture/'.$up_file_name);
     }

     $update_query = mysqli_query($conn, "UPDATE `student` SET wname = '$update_name_student', wGender = '$update_wGender', wdate = '$update_date', wage = '$update_number' , wfile = '$up_file_name' WHERE wemail = '$email'");
     header('location:profile.php');
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
 
  <section id="profile1" class="profile1">
    <div class="container ">
      <?php
        include('../connection.php');
        $sql_subject = mysqli_query($conn,"SELECT * FROM `student` WHERE wemail = '$email' " );
          while($row = $sql_subject->fetch_assoc()){
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row-cols-md-1  row-cols-1 row-cols-lg-1 g-4 px-5">
          <div class="col-md-6  px-1">
            <h5>الملف الشخصي</h5>
            <div class="form-group">
              <label for="name">اسم الطالب:</label>
              <input placeholder="<?php echo $row['wname'] ?>" type="text" name="update_name_student" value="<?php echo $row['wname']; ?>" class="form-control" >
            </div>
            <hr style="color:blue;">
            <div class="form-group">
              <label for="gender">الجنس:</label>
              <input placeholder="<?php echo $row['wGender'] ?>" type="text" name="update_wGender" value="<?php echo $row['wGender']; ?>" class="form-control" >
            </div>
          <hr style="color:blue;">  
        
            <div class="form-group">
              <label for="dob">تاريخ الميلاد:</label>
              <input placeholder="<?php echo $row['wdate'] ?>" type="text" name="update_date" value="<?php echo $row['wdate']; ?>" class="form-control" >
            
            <hr style="color:blue;">
            
            <div class="form-group">
              <label for="age">العمر:</label>
              <input placeholder="<?php echo $row['wage'] ?>" type="text" name="update_number" value="<?php echo $row['wage']; ?>" class="form-control" >
            </div>
            <hr style="color:blue;">
            <div class="form-group">
              <label for="name">المعدل:</label>
              <input placeholder="<?php echo $row['wdegre'] ?>" type="text" name="update_name_student" value="<?php echo $row['wdegre']; ?>" class="form-control" >
            </div>
            <?php }?>
            <?php
              include('../connection.php');
              $sql_subject = mysqli_query($conn,"SELECT * FROM `techer` WHERE wclass = '$class' " );
                while($row = $sql_subject->fetch_assoc()){
            ?>
            <hr style="color:blue;">
            <div class="form-group">
              <label for="name">الأستاذ المشرف:</label>
              <input placeholder="<?php echo $row['wname'] ?>" type="text" name="update_name_student" value="<?php echo $row['wname']; ?>" class="form-control" >
            </div>
            <hr style="color:blue;">
            <div class="form-group">
              <label for="email">بريد الأستاذ:</label>
              <input placeholder="<?php echo $row['wemail'] ?>" type="text" name="update_name_student" value="<?php echo $row['wemail']; ?>" class="form-control" >
            </div>
            <hr style="color:blue;">
            <?php }?>
        </div>
    </div>
</section>


          
  
  
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>