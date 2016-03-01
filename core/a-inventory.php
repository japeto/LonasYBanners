<?php
	include("../include/condb.php");
	if(isSet($_POST['nomcategory']) && isSet($_POST['inventoryprice1']) 
			&& isSet($_POST['inventoryprice2']) && isSet($_POST['inventorycant'])){
		
		$nomcategory=mysqli_real_escape_string($db,$_POST['nomcategory']); 		
		$inventoryprice1=mysqli_real_escape_string($db,$_POST['inventoryprice1']); 		
		$inventoryprice2=mysqli_real_escape_string($db,$_POST['inventoryprice2']); 												
		$inventorycant=mysqli_real_escape_string($db,$_POST['inventorycant']); 										
		
		$result=mysqli_query($db,"INSERT INTO INVENTARIO(NOMBREPRODUCTO, CANTIDADENINVENTARIO, VCONTADOINVENTARIO,"
							." VCREDITOINVENTARIO, FECHAINVENTARIO, LIMITEENINVENTARIO) VALUES "
							."('".$nomcategory."','0','".$inventoryprice1."','"
							.$inventoryprice2."','".date('Y-m-d', time())."','".$inventorycant."')");
								
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['field']) && isSet($_POST['idinventory']) && isSet($_POST['value'])){
		
		$field=mysqli_real_escape_string($db,$_POST['field']); 		
		$idinventory=mysqli_real_escape_string($db,$_POST['idinventory']); 		
		$value=mysqli_real_escape_string($db,$_POST['value']); 												
		if($field != "NOMBREPRODUCTO")
		$result=mysqli_query($db,"UPDATE INVENTARIO SET ".$field."=".$value." WHERE  IDINVENTARIO=".$idinventory." ");
		else{
		$result=mysqli_query($db,"UPDATE INVENTARIO SET ".$field."='".$value."' WHERE  IDINVENTARIO=".$idinventory." ");
		}
										
		if(mysqli_affected_rows($db)==1){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false,'problem'=>$field);
			echo json_encode($arr);
		}
	}	

	if(isSet($_POST['idcategory']) && isSet($_POST['quantity'])){
		
		$idcategory=mysqli_real_escape_string($db,$_POST['idcategory']); 		
		$quantity=mysqli_real_escape_string($db,$_POST['quantity']); 									
		
		$result=mysqli_query($db,"UPDATE INVENTARIO SET CANTIDADENINVENTARIO= CANTIDADENINVENTARIO +'".$quantity."' WHERE  IDINVENTARIO='".$idcategory."' ");
								
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['idcategory']) && isSet($_POST['price1'])&& isSet($_POST['price2'])){
		
		$idcategory=mysqli_real_escape_string($db,$_POST['idcategory']); 		
		$price1=mysqli_real_escape_string($db,$_POST['price1']); 									
		$price2=mysqli_real_escape_string($db,$_POST['price2']); 											
		
		$result=mysqli_query($db,"UPDATE INVENTARIO SET VCONTADOINVENTARIO='".$price1."', VCREDITOINVENTARIO='".$price2."' WHERE  IDINVENTARIO='".$idcategory."' ");
								
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['idinventory']) && isSet($_POST['inventory'])){
		
		$idinventory=mysqli_real_escape_string($db,$_POST['idinventory']); 		
		$inventory=mysqli_real_escape_string($db,$_POST['inventory']); 														

		$result=mysqli_query($db,"DELETE FROM INVENTARIO WHERE IDINVENTARIO='".$idinventory."' AND NOMBREPRODUCTO='".$inventory."'");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}			
?>