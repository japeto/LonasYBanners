<?php
	session_start();
	if (($_SESSION['usertime']) < time()){
		echo '<script>parent.window.location.reload(true);</script>';
	}else{
		$_SESSION['usertime'] = (2*60)+time();
	echo "<!doctype html>";
	echo "<html lang='es'>";
	echo "<head>";
		echo "<script src='manager/jquery.min.js'></script>";
		echo "<script src='manager/jadmin.operations.js'></script>";		
	echo "</head>";
	echo "<h1 style='background:orange;'>ADMINISTRADOR	</h1>";	
	include("../core/c-admin.php");
	}
?>
