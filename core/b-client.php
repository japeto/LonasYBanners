<?php
	include("../include/condb.php");
	if(isSet($_POST['client']) && isSet($_POST['idclient'])){
		
		$idclient=mysqli_real_escape_string($db,$_POST['idclient']); 		
		$client=mysqli_real_escape_string($db,$_POST['client']); 	
			
		$result=mysqli_query($db,"SELECT * FROM CLIENTE,CIUDAD WHERE ".
			"IDCLIENTE = '".$idclient."' AND NOMBRECLIENTE= '".$client."' AND CIUDEPTOCLIENTE = IDCIUDAD ");
			
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($count>0){
			$arr = array ('result'=>'true','DIRECCIONCLIENTE'=>$row['DIRECCIONCLIENTE'],
				'TELEFONOCLIENTE'=>$row['TELEFONOCLIENTE'],'CIUDADCLIENTE'=>$row['CDESCRIPCION']);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false');
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['cityClient'])){
		
		$idcity=mysqli_real_escape_string($db,$_POST['cityClient']); 		
			
		$result=mysqli_query($db,"SELECT * FROM DEPARTAMENTO,CIUDAD WHERE ".
			"DEPARTAMENTO.IDDEPARTAMENTO = CIUDAD.IDDEPARTAMENTO AND IDCIUDAD='".$idcity."'");
			
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($count>0){
			$arr = array ('result'=>'true','CDESCRIPCION'=>$row['CDESCRIPCION'],
				'DDESCRIPCION'=>$row['DDESCRIPCION']);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false');
			echo json_encode($arr);
		}
	}	
?>