<?
	session_start();
	$_SESSION["app_name"] = "SIGO Sistema Integrado para la Gestion Organizacional";
	$_SESSION["title_name"] = "SIGO";
	if(isset($_GET['logout'])){
        session_unset();
	}
?>