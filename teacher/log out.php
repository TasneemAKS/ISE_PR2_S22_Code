<?php
	include('../connection.php');
	session_start();
	
	unset ($_SESSION['email_t']);
	
	session_destroy();
	echo "<script>window.open('../index.php','_self');</script>";
?>