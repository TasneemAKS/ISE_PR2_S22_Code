<?php 


include('connection.php');

if(isset($_GET['login'])){
$wemail=$_GET['wemail'];
$wpassword=$_GET['wpassword'];


$sql_log = mysqli_query($conn, "SELECT * FROM student WHERE wemail='$wemail'AND wpassword='$wpassword'");
if(mysqli_num_rows($sql_log) > 0){
  while($row = $sql_log->fetch_assoc()){
   session_start(); 
   $_SESSION['email_s'] = $wemail;
   $_SESSION['class_s'] = $row['wclass'];
   $_SESSION['name_s'] = $row['wname'];
   
   header('Location:student/coursus.php');
  }
}
else {header('Location:student_login_form.php?q1=1');}

}


?>

<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>تسجيل الدخول</title>

  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="login_style.css" >


<body>
  <div class="form-container">
    <form action="" method="get">
      <h3>تسجيل دخول الطلاب</h3>
      <p>يرجى تعبئة الحقول التالية</p>
      <?php
      error_reporting(0);
      $q1 = $_GET['q1'];  
      if($q1 == 1){echo "email or password is not correct";}
      ?>
      
      <input type="text" name="wemail" required placeholder="اكتب الايميل الخاص بك">  <br>

      <input type="password" name="wpassword" required placeholder="اكتب كلمة السر">  <br>
      
      <input type="submit" name="login" value="تسجيل الدخول" class="form-btn"><br>

      <p>ليس لديك حساب؟ <a href="register_form.php">قم بإنشاء حساب من هنا</a></p> 

    </div>
  </div>


</body>
</html>