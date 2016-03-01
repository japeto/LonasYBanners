<?php
	include("../include/condb.php");
	if(isSet($_POST['username']) && isSet($_POST['password'])){
		$username=mysqli_real_escape_string($db,$_POST['username']); 
		$password=md5(mysqli_real_escape_string($db,$_POST['password'])); 
		$result=mysqli_query($db,"SELECT * FROM japeto.acceso, japeto.usuario
			where NOMBREACCESO = '".$username."' AND CONTRAACCESO= '".$password."' AND NICKUSUARIO = '".$username."'");
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($count==1){
			ini_set("session.cookie_lifetime","100");
			ini_set("session.gc_maxlifetime","100");
			session_start();
			$_SESSION['user_name']=$username;
			$_SESSION['full_name']=$row['NOMBREUSUARIO'];						
			
			$arr = array ('result'=>'true','user_name'=>$username,'full_name'=>$row['NOMBREUSUARIO']);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false','login_name'=>"");
			echo json_encode($arr);
		}
	}
?>

