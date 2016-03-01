<?php
	session_start();
	if (($_SESSION['usertime']) < time()){
		echo '<script>parent.window.location.reload(true);</script>';
	}else{
		$_SESSION['usertime'] = (90*60)+time();
	echo "<!doctype html>";
	echo "<html lang='es'>";
	echo "<head>";
		echo "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>";
		echo "<script src='manager/jquery.min.js'></script>";
		echo "<script src='manager/jcustomer.operations.js'></script>";
	echo "</head>";
	echo "<h1>NUEVO CLIENTE</h1>";	
	include("../core/c-customer.php");
	}
?>
