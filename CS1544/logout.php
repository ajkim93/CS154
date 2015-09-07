<?php 
	$_SESSION = array();
	session_destroy(); 
	session_regenerate_id(TRUE);
	header("Location: start.php");
?>