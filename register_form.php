<?php 

include('connection.php');

if(isset($_POST['adduser'])){

$name=$_POST['wname'];

$sql_name=mysqli_query($conn,"SELECT * FROM `regester` WHERE `wname` = '$name'");
if(mysqli_num_rows($sql_name) > 0){
  header('Location:register_form.php?q1=1');
  exit();
}


$wGender=$_POST['wGender'];
$wdate=$_POST['wdate'];
$wage=$_POST['wage'];
$email=$_POST['wemail'];


$sql_email=mysqli_query($conn,"SELECT * FROM `regester` WHERE `wemail` = '$email'");
if(mysqli_num_rows($sql_email) > 0){
  header('Location:register_form.php?q1=2');
  exit();
}

$wclass=$_POST['wclass'];
$wfile_name =$_FILES["wfile"]["name"];
$wfile_tmp = $_FILES["wfile"]["tmp_name"];
move_uploaded_file($wfile_tmp,'./student/picture/'.$wfile_name);



$sql_insert = mysqli_query($conn, "INSERT INTO `regester`(wname, wGender, wdate, wage, wemail, wclass , wfile) VALUES ('$name','$wGender','$wdate','$wage','$email','$wclass' , '$wfile_name') ");

if($sql_insert){
  echo "<h3>شكراً لتسجيلك في مدرستنا , سيقوم المدير بتفحص تسجيلك و إرسال بريد الكتروني لك</h3>
        <a href='index.php'><button>الصفحة الرئيسية</button></a>";
}
}

?>

<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>إنشاء حساب</title>

  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="login_style.css" >


<body>
  <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
      <h3>إنشاء حساب جديد</h3>
      <p>يرجى تعبئة الحقول التالية</p>
      <?php
      error_reporting(0);
      $q1 = $_GET['q1'];  
      if($q1 == 1){echo "user already exist";}
      if($q1 == 2){echo "email already exist";}
      ?>
      
      <input type="text" name="wname" required placeholder="اكتب اسمك الكامل">  <br/>

      <select name="wGender">
        <option value="female">أنثى</option>
        <option value="male">ذكر</option>
      </select>

      <br>
      <label for="birthday">تاريخ الميلاد:</label><br>
      <input type="date" required name="wdate">  <br>

      <input type="number" name="wage" required placeholder="العمر">  <br>

      <input type="email" name="wemail" required placeholder="اكتب الايميل الخاص بك">  <br>

    <label for="wclass">الصف:</label><br>
    <select name="wclass">
      <option id="الأول" name="wclass" value="الأول">الأول</option>
      <option id="الثاني" name="wclass" value="الثاني" >الثاني</option>
      <option id="الثالث" name="wclass" value="الثالث" >الثالث</option>
      <option id="الرابع" name="wclass" value="الرابع" >الرابع</option>
      <option id="الخامس" name="wclass" value="الخامس" >الخامس</option>
      <option id="السادس" name="wclass" value="السادس" >السادس</option>
    </select>

    <br>
      <label for="wfile">حمّل صورتك الشخصية</label><br>
      <input type="file" name="wfile" accept="image/png, image/jpeg"><br>
      

      <input type="submit" name="adduser" value="إنشاء حساب" class="form-btn"><br>

      <p>لديك حساب بالفعل؟ <a href="student_login_form.php">قم بتسجيل الدخول</a></p> 

    </div>
  </div>


</body>
</html>