<?php 

  include('../connection.php');

  session_start();

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  if (!isset($_SESSION['email_s'])) {
    header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];

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
    <link href="./bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/student.css" >
</head>
<body >
  <header class="header">
          <nav class="navbar navbar-expand-md fixed-top">
       <div class="container-fluid">
           <a class="navbar-brand " href="../index.php">  مصباح العلم 
               <img src="./imag/logo.png" alt="" width="120" height="80">
               </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
         </button>       
       <div class=" collapse navbar-collapse " id="navbarTogglerDemo01">
         <ul  class="navbar-nav  mx-auto mt-4 ms-2 " >
           <li class="nav-item ">
             <a class="nav-link active" aria-current="page" href="log out.php"><button class="pa"> تسجيل الخروج</button> </a>
           </li>
    </header>
  <section id="side-bar" class="side-bar">
 <div class="container-fluid">
    <div class="row flex-nowrap">
       <div style="background-color: rgb(220, 220, 252);" class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
         <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
            <div class="d-flex align-items-center pb-3 mb-md-0 me-md-auto  text-decoration-none">
               <div class="fs-5 d-none d-md-inline"> 
                 <div class="profile  ">
                  <?php
                    include('../connection.php');
                    $sql_subject = mysqli_query($conn,"SELECT * FROM `student` WHERE wemail = '$email' " );
                      while($row = $sql_subject->fetch_assoc()){
                  ?>
                 <div class="row">
                   <div class="col text-center ">
                  <img src="picture/<?php echo $row['wfile'] ?>" alt="" class="rounded-circle">
                 </div>
                 <div class="row">
                  
                <h5 style="color:rgb(153, 153, 244)" class="name text-center"><?php echo $row['wname'] ?></h5>
                </div>
                <div class="row">
                    <p style="color:rgba(153, 153, 244, 0.951)" class=" text-center ">الصف : <?php echo $row['wclass'] ?></p>
                    </div>
                    
             </div>
             <?php  } ?>
           </div>
               </div>                                          
              </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item1">
          <a href="coursus.php" class="nav-link align-middle px-0">
            <i class="fas fa-chalkboard-user"></i> <span class="ms-1 d-none d-md-inline">المواد الدراسية </span>
           </a>
         </li>
         <li>
          <a href="page_work.php"  class="nav-link px-0 align-middle">
            <i class="fas fa-edit"></i> <span class="ms-1 d-none d-md-inline">أوراق العمل </span> </a>
                    
           </li>
         <li>
          <a href="page-quize.php" class="nav-link px-0 align-middle">
             <i class="fas fa-graduation-cap"></i> <span class="ms-1 d-none d-md-inline">الاختبارات</span></a>
          </li>
          <li>
           <a href="marks.php"  class="nav-link px-0 align-middle ">
           <i class="fas fa-check-square"></i> <span class="ms-1 d-none d-md-inline">العلامات</span></a>
          </li>
          <li>
           <a href="actives.php"  class="nav-link px-0 align-middle">
             <i class="fas fa-laugh-beam"></i> <span class="ms-1 d-none d-md-inline">الأنشطة </span> </a>
          </li>
            <li>
             <a href="refrence.php" class="nav-link px-0 align-middle">
          <i class="fas fa-book"></i> <span class="ms-1 d-none d-md-inline">مراجع داعمة </span> </a>
          </li>
          <li>
           <a href="https://mail.google.com/" class="nav-link px-0 align-middle">
            <i class="fa fa-envelope"></i> <span class="ms-1 d-none d-md-inline">البريد الإلكتروني </span> </a>
          </li>
          <li>
            <a href="profile.php" class="nav-link px-0 align-middle">
              <i class="bi bi-person-square"></i>
              <span class="ms-1 d-none d-md-inline">الملف الشخصي </span> </a>
           </li>
          </ul>
          <hr>
    </div>
   </div>
     </div>
    </div>
  </section>
 
    
      
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script> 
 
</body>
</html>