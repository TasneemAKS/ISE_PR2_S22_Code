<?php 

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_s'])) {
    header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];


  // cheack on download subject , here i want to dowload file from file subject ,so i catch the file name ------------->
    
  if(isset($_GET['download_subject'])){
    $filename = basename($_GET['download_subject']);
    $filepath = '../admin/filesubject/' . $filename;

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
  <section id="courses" class="courses">
    <div class="container " >   
      <div style="padding-right:12rem;" class=" row row-cols-1 row-cols-md-1 row-cols-lg-2 g-4 ">
        <?php
        include('../connection.php');
        $sql_subject = mysqli_query($conn,"SELECT * FROM student INNER JOIN subject ON student.wclass = subject.wnameclass WHERE student.wemail = '$email'" );
          while($row = $sql_subject->fetch_assoc()){
        ?>
        <div class="col-xl-5 px-5">
          <div class="card h-100" style="width: 18rem;">
            <h5 class="text-center"><?php echo $row['wnamesub'] ?></h5>
            <img src="../imag/<?php echo $row['wpicture'] ?>" class="card-img-top " alt="...">
            <div class="card-body">
            <a href="coursus.php?download_subject=<?php echo $row['file']; ?>" class="btn btn-primary">تحميل الكتاب </a>
            </div>
          </div>
        </div>
        <?php  } ?>
      </div>       
    </div>
     </section>

 
      
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>