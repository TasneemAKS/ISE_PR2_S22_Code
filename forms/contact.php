<?php 

  include('../connection.php');

    //cheack form send ------------------------------------------------------------------------------------
  if(isset($_POST['submit'])){
    $wname=$_POST['wname'];
    $wemail=$_POST['wemail'];
    $wsubject=$_POST['wsubject'];
    $wmessage=$_POST['wmessage'];

    $sql_add_form = mysqli_query($conn ,"INSERT INTO `contact`(`wname`, `wemail`, `wsubject`, `wmessage`) VALUES ('$wname','$wemail','$wsubject','$wmessage') ");
    header('Location:../index.php');

  }
  //end cheack ----------------------------------------------------------------------------------------------

?>