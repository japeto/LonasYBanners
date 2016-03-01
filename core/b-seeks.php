<?php
	include("../include/condb.php");
	if(isSet($_POST['client'])){		
		$client=mysqli_real_escape_string($db,$_POST['client']); 		
		$result=mysqli_query($db,"select * from CLIENTE,CIUDAD where NOMBRECLIENTE LIKE '%".$client."%' AND CIUDEPTOCLIENTE=IDCIUDAD");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='customer_".$row['IDCLIENTE']."'>"
					."<td class='editable' id='NOMBRECLIENTE_".$row['IDCLIENTE']."' >".$row['NOMBRECLIENTE']."</td>"
					."<td class='editable' id='DIRECCIONCLIENTE_".$row['IDCLIENTE']."' >".$row['DIRECCIONCLIENTE']."</td>"
					."<td id='CDESCRIPCION_".$row['IDCLIENTE']."' >".$row['CDESCRIPCION']."</td>"
					."<td class='editable' id='TELEFONOCLIENTEr_".$row['IDCLIENTE']."' >".$row['TELEFONOCLIENTE']."</td>"
					."<td class='editable' id='NItCLIENTE_".$row['IDCLIENTE']."' >".$row['NItCLIENTE']."</td>"
					."<td class='editable' id='CORREOCLIENTE_".$row['IDCLIENTE']."' >".$row['CORREOCLIENTE']."</td>"
					."<td class='editable' id='CONTACTOCLIENTE_' >".$row['CONTACTOCLIENTE']."</td>"
					."<td>"
					//."<a id='editcustomer_".$row['IDCLIENTE']."' onclick='editrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
					." <a id='delcustomer_".$row['IDCLIENTE']."' onclick='delrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>"																		
					."</tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}

	if(isSet($_POST['contact'])){		
		$contact=mysqli_real_escape_string($db,$_POST['contact']); 		
		$result=mysqli_query($db,"select * from CLIENTE,CIUDAD where CONTACTOCLIENTE LIKE '%".$contact."%' AND CIUDEPTOCLIENTE=IDCIUDAD");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='customer_".$row['IDCLIENTE']."'>"
					."<td class='editable' id='NOMBRECLIENTE_".$row['IDCLIENTE']."' >".$row['NOMBRECLIENTE']."</td>"
					."<td class='editable' id='DIRECCIONCLIENTE_".$row['IDCLIENTE']."' >".$row['DIRECCIONCLIENTE']."</td>"
					."<td id='CDESCRIPCION_".$row['IDCLIENTE']."' >".$row['CDESCRIPCION']."</td>"
					."<td class='editable' id='TELEFONOCLIENTEr_".$row['IDCLIENTE']."' >".$row['TELEFONOCLIENTE']."</td>"
					."<td class='editable' id='NItCLIENTE_".$row['IDCLIENTE']."' >".$row['NItCLIENTE']."</td>"
					."<td class='editable' id='CORREOCLIENTE_".$row['IDCLIENTE']."' >".$row['CORREOCLIENTE']."</td>"
					."<td class='editable' id='CONTACTOCLIENTE_' >".$row['CONTACTOCLIENTE']."</td>"
					."<td>"
					//."<a id='editcustomer_".$row['IDCLIENTE']."' onclick='editrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
					." <a id='delcustomer_".$row['IDCLIENTE']."' onclick='delrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>"																		
					."</tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
		
	if(isSet($_POST['nit'])){		
		$nit=mysqli_real_escape_string($db,$_POST['nit']); 		
		$result=mysqli_query($db,"select * from CLIENTE,CIUDAD where NItCLIENTE LIKE '%".$nit."%' AND CIUDEPTOCLIENTE=IDCIUDAD");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='customer_".$row['IDCLIENTE']."'>"
					."<td class='editable' id='NOMBRECLIENTE_".$row['IDCLIENTE']."' >".$row['NOMBRECLIENTE']."</td>"
					."<td class='editable' id='DIRECCIONCLIENTE_".$row['IDCLIENTE']."' >".$row['DIRECCIONCLIENTE']."</td>"
					."<td id='CDESCRIPCION_".$row['IDCLIENTE']."' >".$row['CDESCRIPCION']."</td>"
					."<td class='editable' id='TELEFONOCLIENTEr_".$row['IDCLIENTE']."' >".$row['TELEFONOCLIENTE']."</td>"
					."<td class='editable' id='NItCLIENTE_".$row['IDCLIENTE']."' >".$row['NItCLIENTE']."</td>"
					."<td class='editable' id='CORREOCLIENTE_".$row['IDCLIENTE']."' >".$row['CORREOCLIENTE']."</td>"
					."<td class='editable' id='CONTACTOCLIENTE_' >".$row['CONTACTOCLIENTE']."</td>"
					."<td>"
					//."<a id='editcustomer_".$row['IDCLIENTE']."' onclick='editrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
					." <a id='delcustomer_".$row['IDCLIENTE']."' onclick='delrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>"																		
					."</tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	/**/
	if(isSet($_POST['dateinvoice'])){		
		$dateinvoice=mysqli_real_escape_string($db,$_POST['dateinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE FECHAFACTURA = '".$dateinvoice."' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['codinvoice'])){		
		$codinvoice=mysqli_real_escape_string($db,$_POST['codinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE CODFACTURA LIKE '%".$codinvoice."%' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['duedateinvoice'])){		
		$duedateinvoice=mysqli_real_escape_string($db,$_POST['duedateinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE VENCIMIENTOFACTURA = '".$duedateinvoice."' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['cliinvoice'])){		
		$cliinvoice=mysqli_real_escape_string($db,$_POST['cliinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE NOMBRECLIENTE LIKE '%".$cliinvoice."%' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}		
	if(isSet($_POST['userinvoice'])){		
		$userinvoice=mysqli_real_escape_string($db,$_POST['userinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE CONTACTOCLIENTE LIKE '%".$userinvoice."%' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['stateinvoice'])){		
		$stateinvoice=mysqli_real_escape_string($db,$_POST['stateinvoice']); 		
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE ESTADOFACTURA = '".$stateinvoice."' AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>"
				 ."<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";			 
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['codinvoicefee'])){		
		$codinvoicefee=mysqli_real_escape_string($db,$_POST['codinvoicefee']); 		
		$result=mysqli_query($db,"SELECT* FROM ABONOSALDO, FACTURA WHERE  FACTURAABONO = IDFACTURA AND CODFACTURA LIKE '%".$codinvoicefee."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDABONOSALDO']."'>"
				 ."<td>".$row['FECHACREACION']."</td>"
				 ."<td>".$row['TIPODEPAGO']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"
				 ."<td>".$row['MONTOABONO']."</td>";
//				 ."<td><a onclick='editrowinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
//				 ." <a onclick='delroinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['datefee'])){		
		$datefee=mysqli_real_escape_string($db,$_POST['datefee']); 		
		$result=mysqli_query($db,"SELECT* FROM ABONOSALDO, FACTURA WHERE  FACTURAABONO = IDFACTURA AND FECHACREACION LIKE '%".$datefee."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDABONOSALDO']."'>"
				 ."<td>".$row['FECHACREACION']."</td>"
				 ."<td>".$row['TIPODEPAGO']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"
				 ."<td>".$row['MONTOABONO']."</td>"
				 ."<td><a onclick='editrowinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
				 ." <a onclick='delroinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	/**/
	if(isSet($_POST['codproduct'])){		
		$codproduct=mysqli_real_escape_string($db,$_POST['codproduct']); 		
		$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO=IDINVENTARIO AND CODPRODUCTO LIKE '%".$codproduct."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .=  "<tr id='product_".$row['IDPRODUCTO']."'>"
				 ."<td class='editable' id='CODPRODUCTO_".$row['IDPRODUCTO']."' >".$row['CODPRODUCTO']."</td>"
				 ."<td class='editable' id='REFERENCIAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['REFERENCIAPRODUCTO']."</td>"
				 ."<td class='' id='MEDIDASPRODUCTO_".$row['IDPRODUCTO']."' >".$row['MEDIDASPRODUCTO']."</td>"										
				 ."<td class='editable' id='VOLUMENPRODUCTO_".$row['IDPRODUCTO']."' >".$row['VOLUMENPRODUCTO']."</td>"
				 ."<td class='' id='AREAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['AREAPRODUCTO']."</td>"
				 ."<td class='editable' id='DESCRIPCIONPRODUCTO_".$row['IDPRODUCTO']."' >".$row['DESCRIPCIONPRODUCTO']."</td>"
				 ."<td class='' id='NOMBREPRODUCTO_".$row['IDPRODUCTO']."' >".$row['NOMBREPRODUCTO']."</td>"
				 ."<td>"
//				 ."<a id='editproduct_".$row['IDPRODUCTO']."' onclick='editrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
				 ."<a id='delproduct_".$row['IDPRODUCTO']."' onclick='delrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a></tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['refproduct'])){		
		$refproduct=mysqli_real_escape_string($db,$_POST['refproduct']); 		
		$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO=IDINVENTARIO AND REFERENCIAPRODUCTO LIKE '%".$refproduct."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .=  "<tr id='product_".$row['IDPRODUCTO']."'>"
				 ."<td class='editable' id='CODPRODUCTO_".$row['IDPRODUCTO']."' >".$row['CODPRODUCTO']."</td>"
				 ."<td class='editable' id='REFERENCIAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['REFERENCIAPRODUCTO']."</td>"
				 ."<td class='' id='MEDIDASPRODUCTO_".$row['IDPRODUCTO']."' >".$row['MEDIDASPRODUCTO']."</td>"										
				 ."<td class='editable' id='VOLUMENPRODUCTO_".$row['IDPRODUCTO']."' >".$row['VOLUMENPRODUCTO']."</td>"
				 ."<td class='' id='AREAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['AREAPRODUCTO']."</td>"
				 ."<td class='editable' id='DESCRIPCIONPRODUCTO_".$row['IDPRODUCTO']."' >".$row['DESCRIPCIONPRODUCTO']."</td>"
				 ."<td class='' id='NOMBREPRODUCTO_".$row['IDPRODUCTO']."' >".$row['NOMBREPRODUCTO']."</td>"
				 ."<td>"
//				 ."<a id='editproduct_".$row['IDPRODUCTO']."' onclick='editrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
				 ."<a id='delproduct_".$row['IDPRODUCTO']."' onclick='delrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a></tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['catproduct'])){		
		$catproduct=mysqli_real_escape_string($db,$_POST['catproduct']); 		
		$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO=IDINVENTARIO AND NOMBREPRODUCTO LIKE '%".$catproduct."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .=  "<tr id='product_".$row['IDPRODUCTO']."'>"
				 ."<td class='editable' id='CODPRODUCTO_".$row['IDPRODUCTO']."' >".$row['CODPRODUCTO']."</td>"
				 ."<td class='editable' id='REFERENCIAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['REFERENCIAPRODUCTO']."</td>"
				 ."<td class='' id='MEDIDASPRODUCTO_".$row['IDPRODUCTO']."' >".$row['MEDIDASPRODUCTO']."</td>"										
				 ."<td class='editable' id='VOLUMENPRODUCTO_".$row['IDPRODUCTO']."' >".$row['VOLUMENPRODUCTO']."</td>"
				 ."<td class='' id='AREAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['AREAPRODUCTO']."</td>"
				 ."<td class='editable' id='DESCRIPCIONPRODUCTO_".$row['IDPRODUCTO']."' >".$row['DESCRIPCIONPRODUCTO']."</td>"
				 ."<td class='' id='NOMBREPRODUCTO_".$row['IDPRODUCTO']."' >".$row['NOMBREPRODUCTO']."</td>"
				 ."<td>"
//				 ."<a id='editproduct_".$row['IDPRODUCTO']."' onclick='editrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>"
				 ."<a id='delproduct_".$row['IDPRODUCTO']."' onclick='delrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a></tr>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	/**/		
	if(isSet($_POST['feeinvoice'])){		
		$feeinvoice=mysqli_real_escape_string($db,$_POST['feeinvoice']); 		
		$result=mysqli_query($db,"select * from abonosaldo,factura,CLIENTE,USUARIO where USUARIOFACTURA=IDUSUARIO"
						." AND FACTURAABONO= IDFACTURA AND IDCLIENTE=CLIENTEFACTURA AND ESTADOFACTURA='PENDIENTE' AND CODFACTURA LIKE '%".$feeinvoice."%' ");										
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDABONOSALDO']."'>"
					."<td>".$row['FECHAFACTURA']."</td>"
					."<td>".$row['CODFACTURA']."</td>"
					."<td>".$row['NOMBRECLIENTE']."</td>"										
					."<td>".$row['MONTOABONO']."</td>"															
					."<td>".$row['VENCIMIENTOFACTURA']."</td>"																				
					."<td>".$row['ESTADOFACTURA']."</td>"																									
					."<td>".$row['CONTACTOCLIENTE']."</td>";																														
//					."<td><a onclick='editclient(this)'><img src='shared/thumbs/edit_pen.png'/></a>"
//					." <a onclick='editclient(this)'><img src='shared/thumbs/edit_del.png'/></a></tr>";
			}
			$arr = array ('result'=>true,'rows'=>$rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
?>
