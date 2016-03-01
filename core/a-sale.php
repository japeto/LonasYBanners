<?php
	include("../include/condb.php");
	
	if(isSet($_POST['categories'])){
		$decodedText = html_entity_decode($_POST['categories']);
		$categories = json_decode($decodedText, true);
		$vector = explode("&", $categories);
		
		$stringresult = true;
		for($i=0; $i<count($vector); $i++){
			$result=mysqli_query($db,"UPDATE INVENTARIO SET CANTIDADENINVENTARIO=".$vector[$i]." WHERE IDINVENTARIO=".($i+1)." ");				

			if($result){
				$stringresult = $stringresult && true;
			}else {
				$stringresult = $stringresult && false;
			}			
		}

		$arr = array ('result'=>$stringresult);
		echo json_encode($arr);		
	}
	
	if(isSet($_POST['dateinvoice']) && isSet($_POST['codinvoice']) && isSet($_POST['idcostumer'])
			&& isSet($_POST['stateinvoice']) && isSet($_POST['quantinvoice']) && isSet($_POST['ids'])
			&& isSet($_POST['qids']) && isSet($_POST['duedate'])&& isSet($_POST['userid'])){
	
		$dateinvoice=date('Y-m-d', strtotime($_POST['dateinvoice']));
		$codinvoice=mysqli_real_escape_string($db,$_POST['codinvoice']); 		
		$idcostumer=mysqli_real_escape_string($db,$_POST['idcostumer']); 		
		$stateinvoice=mysqli_real_escape_string($db,$_POST['stateinvoice']); 	
		$quantinvoice=mysqli_real_escape_string($db,$_POST['quantinvoice']); 	
		$duedate=date('Y-m-d', strtotime($_POST['duedate'])); 	
		$userid=mysqli_real_escape_string($db,$_POST['userid']); 	
		
		$ids=mysqli_real_escape_string($db,$_POST['ids']); 		
		$vector = explode("-", $ids);
		$qids=mysqli_real_escape_string($db,$_POST['qids']); 						
		$vectorq = explode("-", $qids);				
		$stringresult = true;
		
/*		$result=mysqli_query($db,"INSERT INTO FACTURA (FECHAFACTURA, "
			."CODFACTURA, CLIENTEFACTURA, ESTADOFACTURA, MONTOFACTURA, "
			."DETALLEFACTURA, VENCIMIENTOFACTURA, USUARIOFACTURA) "
			."VALUES ('".$dateinvoice."', '".$codinvoice."', ".$idcostumer.", "
			."'".$stateinvoice."', ".$quantinvoice.", '".$ids."', '".$duedate."', ".$userid.")");*/
		$result=mysqli_query($db,"insert into factura (FECHAFACTURA, CODFACTURA, "
							."CLIENTEFACTURA, ESTADOFACTURA, MONTOFACTURA, "
							."factura.DETALLEFACTURA, VENCIMIENTOFACTURA,USUARIOFACTURA) "
							." select '".$dateinvoice."','".$codinvoice."',"
							.$idcostumer.",'".$stateinvoice."',".$quantinvoice.",'"
							.$ids."','".$duedate."',usuario.IDUSUARIO as USUARIOFACTURA "
							."from usuario where NOMBREUSUARIO= '".$userid."' ");
						
		if($result){
			$stringresult = $stringresult && true;
			for($i=0; $i<count($vector); $i++){
				$result=mysqli_query($db,"INSERT INTO DETALLEFACTURA (DETPRODUCTO, DETFACTURA, DETCLIENTE, DETCANTIDAD) "
				."SELECT IDPRODUCTO,IDFACTURA,IDCLIENTE,".$vectorq[$i]." AS DETCANTIDAD FROM PRODUCTO,FACTURA,CLIENTE "
 ."WHERE IDPRODUCTO=".$vector[$i]." AND CODFACTURA='".$codinvoice."' AND IDCLIENTE=".$idcostumer." ");							
	
				if($result){
					$stringresult = $stringresult && true;
				}else {
					$stringresult = $stringresult && false;
				}		
			}				
		}else {
			$stringresult = $stringresult && false;
		}	

		$arr = array ('result'=>$stringresult);
		echo json_encode($arr);				
		
	}
	
	
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

		
		$result=mysqli_query($db,"INSERT INTO CLIENTE (NOMBRECLIENTE, DIRECCIONCLIENTE, CIUDEPTOCLIENTE,".
					"TELEFONOCLIENTE, NItCLIENTE, CORREOCLIENTE, CONTACTOCLIENTE, ESTADOCLIENTE) VALUES ".
					"('".$company."', '".$address."', '".$idcity."', '".$phone."', '".$nit."',".
					" '".$mail."', '".$contact."', 'ACTIVO')");
										
		if($result){
			$arr = array ('result'=>'true');
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false');
			echo json_encode($arr);
		}
	}
	
	if(isSet($_POST['idcostumer']) && isSet($_POST['costumer'])){
		
		$idcostumer=mysqli_real_escape_string($db,$_POST['idcostumer']); 		
		$costumer=mysqli_real_escape_string($db,$_POST['costumer']); 														

		$result=mysqli_query($db,"DELETE FROM CLIENTE WHERE IDCLIENTE='".$idcostumer."' AND NOMBRECLIENTE='".$costumer."'");
										
		if($result){
			$arr = array ('result'=>'true');
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>'false');
			echo json_encode($arr);
		}
	}	
	
	if(isSet($_POST['showinvoice'])){														

	$showinvoice=mysqli_real_escape_string($db,$_POST['showinvoice']); 
	
		$result=mysqli_query($db,"SELECT * FROM DETALLEFACTURA,FACTURA,CLIENTE,PRODUCTO,INVENTARIO,CIUDAD WHERE DETFACTURA = IDFACTURA  AND DETCLIENTE=IDCLIENTE AND DETPRODUCTO=IDPRODUCTO AND CATEGORIAPRODUCTO=IDINVENTARIO "
		."AND CIUDEPTOCLIENTE= IDCIUDAD AND CODFACTURA='".$showinvoice."' ");
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows ="<table width='100%' id='contenido' >
<thead>
<tr >
<th style='border:2px solid #000; font-size:80%;' >COD. PRODUCTO</th>
<th style='border:2px solid #000; font-size:80%;' >CANTIDAD</th>
<th style='border:2px solid #000; font-size:80%;' >DESCRIPCIÓN</th>
<th style='border:2px solid #000; font-size:80%;' >MTS.</th>
<th style='border:2px solid #000; font-size:80%;' >VALOR MT2</th>
<th style='border:2px solid #000; font-size:80%;' >V. UNIDAD</th>
<th style='border:2px solid #000; font-size:80%;' >V. TOTAL</th>		
</tr>
</thead>
<tbody id='filas' style='float:center; text-align:center;'>";
			while($row = mysqli_fetch_assoc($result)) {		
				$nclient =$row['NOMBRECLIENTE'];
				$dclient =$row['DIRECCIONCLIENTE'];			
				$tclient =$row['TELEFONOCLIENTE'];
				$ccclient =$row['CDESCRIPCION'];						
				$nfactura =$row['CODFACTURA'];
				$ffactura =$row['FECHAFACTURA'];			
				$fpago = $row['CESTADO'];
				$stfactura =$row['ESTADOFACTURA'];
				$subval =$row['MONTOFACTURA'];
				$totalval =$row['MONTOFACTURA'];															
				$rows .= "<tr>"
					."<td>".$row['CODPRODUCTO']."</td>"
					."<td>".$row['DETCANTIDAD']."</td>"
					."<td>".$row['REFERENCIAPRODUCTO']."</td>"
					."<td>".$row['AREAPRODUCTO']."</td>"
					."<td>".$row['VCONTADOINVENTARIO']."</td>"																				
					."<td>".$row['AREAPRODUCTO']*$row['VCONTADOINVENTARIO']."</td>"
					."<td>".$row['AREAPRODUCTO']*$row['VCONTADOINVENTARIO']*$row['DETCANTIDAD']."</td>"
					."</tr>";
			}	
			$rows .= "</tbody></table>";
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows,
						'nclient'=>$nclient,'dclient'=>$dclient,
						'tclient'=>$tclient,'ccclient'=>$ccclient,'nfactura'=>$nfactura,
						'ffactura'=>$ffactura,'fpago'=>$fpago,
						'stfactura'=>$stfactura,'subval'=>$subval,'totalval'=>$totalval);
			echo json_encode($arr);		
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
?>
