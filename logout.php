<?php 
	session_start();
	$_SESSION = array();
	session_destroy();
	header('location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
?>