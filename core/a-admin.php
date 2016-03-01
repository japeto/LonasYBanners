<?php
	include("../include/condb.php");
	if(isSet($_POST['nick']) && isSet($_POST['pass']) 
			&& isSet($_POST['rol']) && isSet($_POST['name'])
				&& isSet($_POST['tel']) && isSet($_POST['mail']) && isSet($_POST['quest'])
				&& isSet($_POST['answ'])){
					
		$nick=mysqli_real_escape_string($db,$_POST['nick']); 		
		$pass=md5(mysqli_real_escape_string($db,$_POST['pass'])); 		
		$rol=mysqli_real_escape_string($db,$_POST['rol']); 												
		$name=mysqli_real_escape_string($db,$_POST['name']); 				
		$tel=mysqli_real_escape_string($db,$_POST['tel']); 				
		$mail=mysqli_real_escape_string($db,$_POST['mail']); 				
		$quest=mysqli_real_escape_string($db,$_POST['quest']); 								
		$answ=mysqli_real_escape_string($db,$_POST['answ']); 										
		
		$exist=mysqli_query($db,"SELECT * FROM ACCESO WHERE NOMBREACCESO='".$nick."' ");
		$count=mysqli_num_rows($exist);	
		
		if($count>0){
			$arr = array ('result'=>false,'problem'=>$count);
			echo json_encode($arr);
		}else{	
		
			$result=mysqli_query($db,"INSERT INTO ACCESO (NOMBREACCESO, CONTRAACCESO, ROLES_IDROLES)"
									." VALUES ('".$nick."', '".$pass."',".$rol.")");
									
			$result= $result && mysqli_query($db,"INSERT INTO USUARIO (NOMBREUSUARIO, NICKUSUARIO, "
										."TELEFONOUSUARIO, EMAILUSUSARIO, ESTADOUSUSARIO, PREGUNTAUSUARIO, "
										."RESPUESTAUSUSARIO, INTENTOSUSUARIO, ACCESO_IDACCESO) "
."SELECT '".$name."' AS NOMBREUSUARIO, '".$nick."' AS NICKUSUARIO, '".$tel."' AS TELEFONOUSUARIO, '".$mail."' AS EMAILUSUSARIO, 1 AS ESTADOUSUSARIO, '".$quest."'AS PREGUNTAUSUARIO, '".$answ."' AS RESPUESTAUSUSARIO, 0 AS INTENTOSUSUARIO , IDACCESO FROM ACCESO WHERE NOMBREACCESO='".$nick."' ");					
								
			if($result){
				$arr = array ('result'=>true);
				echo json_encode($arr);
			}else {
				$arr = array ('result'=>false,'problem'=>$rol);
				echo json_encode($arr);
			}
		}
	}	

	if(isSet($_POST['codincrement1']) && isSet($_POST['codincrement2'])){
		
		$codincrement1=mysqli_real_escape_string($db,$_POST['codincrement1']); 		
		$codincrement2=mysqli_real_escape_string($db,$_POST['codincrement2']); 		

		$result=mysqli_query($db,"UPDATE SISTEMA SET CONSECUTIVOIVA=".$codincrement1.", CONSECUTIVO=".$codincrement2." ");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	
?>