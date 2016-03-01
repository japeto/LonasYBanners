<?php
	include("../include/condb.php");
	if(isSet($_POST['nameuser']) && isSet($_POST['namefull'])){
				
		$namefull=mysqli_real_escape_string($db,$_POST['namefull']); 		
		$nameuser=mysqli_real_escape_string($db,$_POST['nameuser']); 				
				
		$result=mysqli_query($db,"SELECT * FROM USUARIO WHERE NOMBREUSUARIO= '".$namefull."' AND NICKUSUARIO= '".$nameuser."' ");
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);		
		
		if($count==1){	
			$arr = array ('result'=>true,'mail'=>$row['EMAILUSUSARIO'],
					'phone'=>$row['TELEFONOUSUARIO'],'question'=>$row['PREGUNTAUSUARIO'],'response'=>$row['RESPUESTAUSUSARIO']);				
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>$namefull);
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['delnameuser']) && isSet($_POST['delnamefull'])){
				
		$delnamefull=mysqli_real_escape_string($db,$_POST['delnamefull']); 		
		$delnameuser=mysqli_real_escape_string($db,$_POST['delnameuser']); 				
	}	
	if(isSet($_POST['oldpassword']) && isSet($_POST['newpassword']) && isSet($_POST['user'])){
				
		$oldpassword=md5(mysqli_real_escape_string($db,$_POST['oldpassword'])); 		
		$newpassword=md5(mysqli_real_escape_string($db,$_POST['newpassword'])); 
		$user=mysqli_real_escape_string($db,$_POST['user']); 						
						
		$result=mysqli_query($db,
		"UPDATE ACCESO SET CONTRAACCESO='".$newpassword."' WHERE NOMBREACCESO='".$user."' AND CONTRAACCESO='".$oldpassword."' ");
		
		if(mysqli_affected_rows($db)==1){	
			$arr = array ('result'=>true);				
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}		
	}	
	if(isSet($_POST['loginname']) && isSet($_POST['upnamefull']) && isSet($_POST['upresponseuser'])){
				
		$loginname=mysqli_real_escape_string($db,$_POST['loginname']);
		$upnamefull=mysqli_real_escape_string($db,$_POST['upnamefull']); 
		$upmailuser=mysqli_real_escape_string($db,$_POST['upmailuser']); 
		$upteluser=mysqli_real_escape_string($db,$_POST['upteluser']); 		
		$upquestionuser=mysqli_real_escape_string($db,$_POST['upquestionuser']); 				
		$upresponseuser=mysqli_real_escape_string($db,$_POST['upresponseuser']); 									
						
		$result=mysqli_query($db,"UPDATE japeto.usuario SET NOMBREUSUARIO='".$upnamefull."', "
		."PREGUNTAUSUARIO='".$upquestionuser."', TELEFONOUSUARIO='".$upteluser."', "
		." EMAILUSUSARIO='".$upmailuser."', RESPUESTAUSUSARIO='".$upresponseuser."' "
		."WHERE  NICKUSUARIO='".$loginname."';");
		
		if($result){	
			$arr = array ('result'=>true);				
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}		
	}		
?>
