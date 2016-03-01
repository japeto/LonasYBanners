<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'japeto');
	define('DB_PASSWORD', 'japeto');
	define('DB_DATABASE', 'japeto');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	if(!$db){
			include("../core/c-login.php");
			include("../core/c-logout.php");
	}	
?>
