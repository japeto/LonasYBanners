<?php
	session_start();
	if (($_SESSION['usertime']) < time()){
		echo '<script>parent.window.location.reload(true);</script>';
	}else{
		$_SESSION['usertime'] = (90*60)+time();
	echo "<!doctype html>";
	echo "<html lang='es'>";
	echo "<head>";
		echo "<script src='manager/jquery.min.js'></script>";
		echo "<script src='manager/jseek.operations.js'></script>";
		echo "<script src='manager/jfee.operations.js'></script>";			
	echo "</head>";
	echo "<h1>BUSCAR ABONO Y CUOTAS</h1>";
	include("../core/c-seekfee.php");
	}
?>
