<?php 
    // LOGOUT ISLEMI
	session_start();
	session_destroy();

	header("location:index.php");
	exit;
?>