<?php
session_start();include("include/session.php");if(empty($_SESSION['full_name'])){include("view/w-login.php");}else{include("view/w-home.php");}
?>
