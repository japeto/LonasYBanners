<?php
	include("../include/condb.php");
	if(isSet($_POST['product']) && isSet($_POST['idproduct']) && isSet($_POST['idproduct'])){
		$idproduct=mysqli_real_escape_string($db,$_POST['idproduct']); 		
		$product=mysqli_real_escape_string($db,$_POST['product']); 		
		
		$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO = IDINVENTARIO ".
		"AND CODPRODUCTO = '".$product."' AND IDPRODUCTO='".$idproduct."' ");
			
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($count>0){
			$arr = array ('result'=>'true','CATEGORIAPRODUCTO'=>$row['CATEGORIAPRODUCTO'],
										'VCONTADOINVENTARIO'=>$row['VCONTADOINVENTARIO'],
										'REFERENCIAPRODUCTO'=>$row['REFERENCIAPRODUCTO'],
										'AREAPRODUCTO'=>$row['ANCHOPRODUCTO']*$row['LARGOPRODUCTO'],
										'DISPONIBLEPRODUCTO'=>$row['CANTIDADENINVENTARIO'],																				
										'LIMITEPRODUCTO'=>$row['LIMITEENINVENTARIO'],										
										'VCREDITOINVENTARIO'=>$row['VCREDITOINVENTARIO']);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false');
			echo json_encode($arr);
		}
	}
?>
