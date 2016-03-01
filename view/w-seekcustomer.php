<?php
	echo "<!doctype html>";
	echo "<html lang='es'>";
	echo "<head>";
		echo "<link rel='stylesheet' href='shared/style.css'/>";
		echo "<script src='manager/jquery.min.js'></script>";
		echo "<script src='manager/jseek.operations.js'></script>";
		echo "<script src='manager/jcustomer.operations.js'></script>";	
	echo "</head>";
	echo "<h1>BUSCAR CLIENTES</h1>";
	include("../core/c-seekcustomer.php");
?>
