<?php
	include('../connection.php');
	session_start();
	
	unset ($_SESSION['email_s']);
	
	session_destroy();
	echo "<script>window.open('../index.php','_self');</script>";
?>