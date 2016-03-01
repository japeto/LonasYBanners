<?php
	include("../include/condb.php");
	if(isSet($_POST['company']) && isSet($_POST['address']) 
			&& isSet($_POST['idcity']) && isSet($_POST['phone'])
				&& isSet($_POST['nit']) && isSet($_POST['mail']) && isSet($_POST['contact'])){
					
		$company=mysqli_real_escape_string($db,$_POST['company']); 		
		$address=mysqli_real_escape_string($db,$_POST['address']); 		
		$contact=mysqli_real_escape_string($db,$_POST['contact']); 												
		$idcity=mysqli_real_escape_string($db,$_POST['idcity']); 				
		$phone=mysqli_real_escape_string($db,$_POST['phone']); 				
		$nit=mysqli_real_escape_string($db,$_POST['nit']); 				
		$mail=mysqli_real_escape_string($db,$_POST['mail']); 								
		$exist=mysqli_query($db,"SELECT * FROM CLIENTE WHERE NOMBRECLIENTE='".$company."' AND NItCLIENTE='".$nit."'");
		$count=mysqli_num_rows($exist);	
		if($count>0){
			$arr = array ('result'=>false,'problem'=>$count);
			echo json_encode($arr);
		}else{	
		
			$result=mysqli_query($db,"INSERT INTO CLIENTE (NOMBRECLIENTE, DIRECCIONCLIENTE, CIUDEPTOCLIENTE,".
						"TELEFONOCLIENTE, NItCLIENTE, CORREOCLIENTE, CONTACTOCLIENTE, ESTADOCLIENTE) VALUES ".
						"('".$company."', '".$address."', ".$idcity.", '".$phone."', '".$nit."',".
						" '".$mail."', '".$contact."', 'ACTIVO')");
											
			if($result){
				$arr = array ('result'=>true);
				echo json_encode($arr);
			}else {
				$arr = array ('result'=>false,'problem'=>$result);
				echo json_encode($arr);
			}
		}
	}	
	
	if(isSet($_POST['field']) && isSet($_POST['idcostumer']) && isSet($_POST['value'])){
		
		$field=mysqli_real_escape_string($db,$_POST['field']); 		
		$idcostumer=mysqli_real_escape_string($db,$_POST['idcostumer']); 		
		$value=mysqli_real_escape_string($db,$_POST['value']); 												

		$result=mysqli_query($db,"UPDATE CLIENTE SET ".$field."='".$value."' WHERE  IDCLIENTE='".$idcostumer."' ");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['idcostumer']) && isSet($_POST['costumer'])){
		
		$idcostumer=mysqli_real_escape_string($db,$_POST['idcostumer']); 		
		$costumer=mysqli_real_escape_string($db,$_POST['costumer']); 														

		$result=mysqli_query($db,"DELETE FROM CLIENTE WHERE IDCLIENTE='".$idcostumer."' AND NOMBRECLIENTE='".$costumer."'");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['delcompany']) && isSet($_POST['delphone'])&& isSet($_POST['delnit'])){
		
		$company=mysqli_real_escape_string($db,$_POST['delcompany']); 		
		$phone=mysqli_real_escape_string($db,$_POST['delphone']); 
		$nit=mysqli_real_escape_string($db,$_POST['delnit']); 																

		$result=mysqli_query($db,"DELETE FROM CLIENTE WHERE NOMBRECLIENTE='".$company."' AND TELEFONOCLIENTE='".$phone."' AND NItCLIENTE='".$nit."' ");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}		
		
?>