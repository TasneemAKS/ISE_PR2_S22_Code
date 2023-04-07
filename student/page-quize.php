<?php 

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_s'])) {
    header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];
  $class_student = $_SESSION['class_s'];
  
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
  <?php include('student.php') ?>
  <section id="page_quize" class="page_quize">
    <div class="container " > 
      <div style="padding-right:12rem;" class=" row row-cols-1 row-cols-md-1 row-cols-lg-2 g-4 ">
        <?php
        include('../connection.php');
        $sql_exam = mysqli_query($conn,"SELECT * FROM exam WHERE class_name = '$class_student'" );
          while($row = $sql_exam->fetch_assoc()){  
        ?>
        <div class="col-xl-5 px-5">
          <div class="card h-100" style="width: 18rem;"> 
              <h5 class="text-center" ><?php echo $row['exam_name'] ?></h5>               
              <img src="../imag/<?php echo $row['wpicture'] ?>" class="card-img-top " alt="...">
              <div class="card-body">
              <a href="<?php echo $row['wlink'] ?>" class="btn btn-secondary" >بدء الاختبار</a>
              <span class="text-end">مدة الامتحان ساعة</span>
              </div>
          </div>
        </div>
      <?php }?> 
      </div>          
    </div>
  </section>

  
      
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>