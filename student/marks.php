<?php 

  //cheack if student log in from log in page and session is start , if is not header to log in page ---------------------
  include('../connection.php');

  session_start();

  if (!isset($_SESSION['email_s'])) {
  header('Location:../student_login_form.php');
  }

  $email = $_SESSION['email_s'];
  $name_stu = $_SESSION['name_s'];
  $class = $_SESSION['class_s'];
  
  //count result ---------------------------------------------------------------------------------------------------------------------
  $sql_result = mysqli_query($conn,"SELECT wid , whw , wexam FROM mark INNER JOIN student WHERE student.wname = mark.wnamestudent " );
  while($row = $sql_result->fetch_assoc()){
    $result = $row['whw'] + $row['wexam'];
    $id = $row['wid'];
    $sql_update = mysqli_query($conn ,"UPDATE `mark` SET  wresult = '$result' WHERE wid = $id ");
    
  }


  //count degre ---------------------------------------------------------------------------------------------------------------------
  $x = 0;
  $sql_result = mysqli_query($conn,"SELECT wresult , wnamestudent FROM mark WHERE wnamestudent = '$name_stu' " );
  while($row = $sql_result->fetch_assoc()){
     
     $result = $row['wresult'];
     $x = $result + $x;   
  }
  $y = mysqli_num_rows($sql_result);
  $degre = $x/$y;
  $sql_update = mysqli_query($conn ,"UPDATE `student` SET  wdegre = '$degre' WHERE wname = '$name_stu' "); 

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

  <?php include ('student.php'); ?>

  <section id="marks" class="marks">
   
        <div class="container mt-3">
            
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-5 g-4 px-5">
                <table class="table  table-bordered">
                <thead>
                    <tr>
                      <th class="col"><h4>اسم المادة</h4></th>
                      <th class="col"><h4>علامة ورقة العمل</h4></th>
                      <th  class="col"><h4>علامة الامتحان</h4></div></th>
                      <th class="col"><h4>المحصلة</h4> </th>
                    </tr>
                  </thead>
                  <?php
			          include('../connection.php');
			          $sql_mark = mysqli_query($conn,"SELECT * FROM mark WHERE wnamestudent = '$name_stu' " );
			            while($row = $sql_mark->fetch_assoc()){
		          ?>
                  <tbody>
                    <tr>
                      <td><?php echo $row['wnamesub'] ?></td>
                      <td><?php echo $row['whw'] ?></td>
                      <td><?php echo $row['wexam'] ?></td>
                      <td><?php echo $row['wresult'] ?></td>
                    </tr>  
                  </tbody>
                  <?php  } ?>
            
              
            </div>
                        
             </table> 
        </div>        
            
   
    </section>
 
      
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./aos/aos.js"></script> 
 
 
</body>
</html>