<?php
	include("../include/condb.php");
	if(isSet($_POST['refproduct']) && isSet($_POST['codproduct']) 
			&& isSet($_POST['widthproduct']) && isSet($_POST['longproduct'])
			&& isSet($_POST['volproduct']) && isSet($_POST['areaproduct'])
				&& isSet($_POST['categoryproduct']) && isSet($_POST['descriproduct'])){
		
		$refproduct=mysqli_real_escape_string($db,$_POST['refproduct']); 		
		$codproduct=mysqli_real_escape_string($db,$_POST['codproduct']); 		
		$widthproduct=mysqli_real_escape_string($db,$_POST['widthproduct']); 												
		$longproduct=mysqli_real_escape_string($db,$_POST['longproduct']); 				
		$volproduct=mysqli_real_escape_string($db,$_POST['volproduct']); 				
		$areaproduct=mysqli_real_escape_string($db,$_POST['areaproduct']); 				
		$categoryproduct=mysqli_real_escape_string($db,$_POST['categoryproduct']); 								
		$descriproduct=mysqli_real_escape_string($db,$_POST['descriproduct']); 										
		
		$exist=mysqli_query($db,"SELECT * FROM PRODUCTO WHERE CODPRODUCTO='".$codproduct."' AND REFERENCIAPRODUCTO='".$refproduct."'");
		$count=mysqli_num_rows($exist);	
		if($count>0){
			$arr = array ('result'=>false,'problem'=>$count);
			echo json_encode($arr);
		}else{				
			$result=mysqli_query($db,"INSERT INTO PRODUCTO (CODPRODUCTO, REFERENCIAPRODUCTO, "
							."MEDIDASPRODUCTO, VOLUMENPRODUCTO, AREAPRODUCTO, DESCRIPCIONPRODUCTO, "
							."ANCHOPRODUCTO, LARGOPRODUCTO, CATEGORIAPRODUCTO) VALUES "
							."('".$codproduct."', '".$refproduct."', '".$widthproduct."x".$longproduct."', '".$volproduct."', ".$areaproduct.", '".$descriproduct."', ".$widthproduct.", ".$longproduct.", ".$categoryproduct.")");
											
			if($result){
				$arr = array ('result'=>true);
				echo json_encode($arr);
			}else {
				$arr = array ('result'=>false,'problem'=>$result);
				echo json_encode($arr);
			}
		}
	}
	if(isSet($_POST['field']) && isSet($_POST['idproduct']) && isSet($_POST['value'])){
		
		$field=mysqli_real_escape_string($db,$_POST['field']); 		
		$idproduct=mysqli_real_escape_string($db,$_POST['idproduct']); 		
		$value=mysqli_real_escape_string($db,$_POST['value']); 												

		$result=mysqli_query($db,"UPDATE PRODUCTO SET ".$field."='".$value."' WHERE  IDPRODUCTO=".$idproduct." ");
												
		if(mysqli_affected_rows($db)==1){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false,'problem'=>$result);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['idproduct']) && isSet($_POST['product'])){
		
		$idproduct=mysqli_real_escape_string($db,$_POST['idproduct']); 		
		$product=mysqli_real_escape_string($db,$_POST['product']); 														

		$result=mysqli_query($db,"DELETE FROM PRODUCTO WHERE IDPRODUCTO='".$idproduct."' AND CODPRODUCTO='".$product."'");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false,'problem'=>$result);
			echo json_encode($arr);
		}	
	}	
	if(isSet($_POST['delrefProduct']) &&  isSet($_POST['delcodproduct'])){
		
		$delrefProduct=mysqli_real_escape_string($db,$_POST['delrefProduct']); 		
		$delcodproduct=mysqli_real_escape_string($db,$_POST['delcodproduct']); 																

		$result=mysqli_query($db,"DELETE FROM PRODUCTO WHERE REFERENCIAPRODUCTO='".$delrefProduct."' AND CODPRODUCTO='".$delcodproduct."' ");
										
		if(mysqli_affected_rows($db)>0){
			$arr = array ('result'=>true);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false,'problem'=>$result);
			echo json_encode($arr);
		}
	}	
?>
