<?php
	session_start();
	if(!empty($_SESSION['full_name'])){
		$_SESSION['user_name']='';
		$_SESSION['full_name']='';
	}
	//~ session_start();
	//~ session_unset();
	//~ session_destroy();
	header("Location:../index.php");
?>
